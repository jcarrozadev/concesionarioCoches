////////////////// Delete car //////////////////

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
                    fetch(deleteRoute, {  // No pasamos ID en la URL
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


////////////////// Edit car //////////////////

const editCar = document.querySelectorAll('.edit-btn');
let token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
editCar.forEach(btn => {
    btn.addEventListener('click', function (e) {
        let id = this.getAttribute('data-id');
        let name = this.getAttribute('data-name');
        let brandId = this.getAttribute('data-brand-id');
        let typeId = this.getAttribute('data-type-id');
        let colorId = this.getAttribute('data-color-id');
        let year = this.getAttribute('data-year');
        let horsepower = this.getAttribute('data-horsepower');
        let price = this.getAttribute('data-price');
        let mainImg = this.getAttribute('data-mainImg');
        let sale = this.getAttribute('data-sale');
        
        document.getElementById('editIdCar').value = id;
        document.getElementById('editNameCar').value = name;
        document.getElementById('editBrandCar').value = brandId;
        document.getElementById('editTypeCar').value = typeId;
        document.getElementById('editColorCar').value = colorId;
        document.getElementById('editYearCar').value = year;
        document.getElementById('editCvCar').value = horsepower;
        document.getElementById('editPriceCar').value = price;
        document.getElementById('mainImg').src = mainImg;
        sale==1 ? document.getElementById('editOfferCar').checked = true : document.getElementById('editOfferCar').checked = false;

    });
});

document.getElementById('editSubmit').addEventListener('click', function(event) {
    event.preventDefault();
    swal({
        title: "¿Estás seguro?",
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
                text: "Sí, ¡Modificar!",
                value: true, 
                visible: true,
                className: "btn-confirm",
                closeModal: true 
            }
        },
        }).then(function(result) {
            if (result) {
                document.getElementById('form-editCar').submit();
            }
        });
});




document.addEventListener('DOMContentLoaded', function () {
    const addImageButton = document.getElementById('editAddImage');
    const extraImagesDiv = document.getElementById('editExtraImages');

    if (!addImageButton || !extraImagesDiv) {
        console.error("No se encontraron los elementos necesarios en el DOM.");
        return;
    }

    const toggleAddImageButton = () => {
        const fileInputs = extraImagesDiv.querySelectorAll('input[type="file"]');
        const lastInput = fileInputs[fileInputs.length - 1];
        if (lastInput && lastInput.files && lastInput.files.length > 0) {
            addImageButton.disabled = false;
        } else {
            addImageButton.disabled = true;
        }
    };

    addImageButton.addEventListener('click', function () {

        let newInputDiv = document.createElement('div');
        newInputDiv.classList.add('col-12', 'mt-2', 'image-input');

        let newInput = document.createElement('input');
        newInput.classList.add('form-control');
        newInput.type = 'file';
        newInput.name = 'formFile[]';
        newInput.accept = 'image/*';
        newInput.required = true;

        newInput.addEventListener('change', toggleAddImageButton);

        let removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-danger', 'mt-2');
        removeButton.innerHTML = 'Eliminar';

        // Evento para eliminar el input
        removeButton.addEventListener('click', function () {
            newInputDiv.remove();
            toggleAddImageButton();
        });

        newInputDiv.appendChild(newInput);
        newInputDiv.appendChild(removeButton);

        extraImagesDiv.appendChild(newInputDiv);

        addImageButton.disabled = true;
    });

    document.getElementById('form-editCar').addEventListener('submit', function (event) {
        let extraInputs = extraImagesDiv.querySelectorAll('input[type="file"]');
        extraInputs.forEach(function (input) {
            if (!input.files || input.files.length === 0) {
                input.setCustomValidity('Por favor, selecciona una imagen.');
            } else {
                input.setCustomValidity('');
            }
        });
    });
});



//Bootstrap validations
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

