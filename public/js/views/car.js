const delete_car = document.querySelectorAll('.delete-car');
    

delete_car.forEach(btn => {
    btn.addEventListener('click', function (e) {
        let id = this.getAttribute('data-car-id');
        console.log(id);
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        swal({
            title: "¿Estás seguro de eliminar el vehículo?",
            text: "Esta acción no se puede remover.",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancelar", 
                    value: null,
                    visible: true,
                    className: "btn-cancel",
                    closeModal: true
                },
                confirm: {
                    text: "Sí, ¡Borrar!",
                    value: true, 
                    visible: true,
                    className: "btn-confirm",
                    closeModal: true 
                }
            },
            }).then(function(result) {
                if (result) {
                    fetch("/admin/delete_car", {  // No pasamos ID en la URL
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            "X-CSRF-TOKEN": token
                        },
                        body: JSON.stringify({ car_id: id }) 
                    })
                    .then(response => response.json()) 
                    .then(data => {
                        if (data.success) {
                            swal("¡Eliminado!", data.success, "success")
                            .then(() => location.reload());
                        } else if (data.error) {
                            swal("Error", data.error, "error");
                        }
                    })
                    .catch(error => {
                        swal("Error", "Hubo un problema en el servidor.", "error");
                        console.error("Error:", error);
                    });
                }
            });
    });
});

(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
})()

document.addEventListener("DOMContentLoaded", function () {

    let addImageButton = document.getElementById("addImage");
    let mainImageInput = document.getElementById("addFormFile");
    let extraImagesDiv = document.getElementById("addExtraImages");

    addImageButton.disabled = true;

    let addingImage = false;

    mainImageInput.addEventListener("change", function () {
        addImageButton.disabled = mainImageInput.files.length === 0;
    });

    addImageButton.addEventListener("click", function () {
        if (addingImage || addImageButton.disabled) return;
        addingImage = true;

        let newInputDiv = document.createElement("div");
        newInputDiv.classList.add("col-12", "mt-2", "image-input");

        let newInput = document.createElement("input");
        newInput.classList.add("form-control");
        newInput.type = "file";
        newInput.name = "img[]";
        newInput.accept = "image/*";
        newInput.required = true;

        newInput.addEventListener("change", function () {
            addImageButton.disabled = newInput.files.length === 0;
        });

        let removeButton = document.createElement("button");
        removeButton.type = "button";
        removeButton.classList.add("btn", "btn-danger", "mt-2");
        removeButton.innerHTML = "Eliminar";
        removeButton.addEventListener("click", function () {
            extraImagesDiv.removeChild(newInputDiv);
            if (extraImagesDiv.children.length === 0) {
                addImageButton.disabled = mainImageInput.files.length === 0;
            }
        });

        newInputDiv.appendChild(newInput);
        newInputDiv.appendChild(removeButton);

        extraImagesDiv.appendChild(newInputDiv);
        addImageButton.disabled = true;
        addingImage = false;
        });
});