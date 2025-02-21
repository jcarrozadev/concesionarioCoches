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

    // Deshabilitar el botón al inicio
    addImageButton.disabled = true;

    // Flag para controlar que no se agregue más de un input a la vez
    let addingImage = false;

    // Habilitar el botón cuando el input principal tenga un archivo seleccionado
    mainImageInput.addEventListener("change", function () {
        addImageButton.disabled = mainImageInput.files.length === 0;
    });

    addImageButton.addEventListener("click", function () {
        if (addingImage || addImageButton.disabled) return;
        addingImage = true;

        // Crear el contenedor del input y botón eliminar
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

        // Agregar elementos al contenedor
        newInputDiv.appendChild(newInput);
        newInputDiv.appendChild(removeButton);

        // Añadir al contenedor principal
        extraImagesDiv.appendChild(newInputDiv);
        addImageButton.disabled = true;
        addingImage = false;
        });
});