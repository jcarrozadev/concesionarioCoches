document.addEventListener('DOMContentLoaded', function () {
    ////////////////////////////////////// Add car //////////////////////////////////////
    const formAddCar = document.getElementById('form-addCar');
    if (formAddCar) {
    setupFormValidationAdd(formAddCar, document.querySelector('#form-addCar button[type="submit"]'));

    function resetFormValidation() {
        const inputs = formAddCar.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.classList.remove('is-invalid', 'is-valid');
            input.dataset.touched = 'false'; // Resetea el estado de interacción
        });
    }}

    function setupFormValidationAdd(form, submitButton) {
        const inputs = form.querySelectorAll('input, select');

        function validateForm() {
            let formIsValid = true;
            inputs.forEach(input => {
                if (!validateFieldAdd(input)) {
                    formIsValid = false;
                }
            });
            submitButton.disabled = !formIsValid;
        }

        inputs.forEach(input => {
            input.dataset.touched = 'false'; 
            input.addEventListener('input', function() {
                input.dataset.touched = 'true'; 
                validateForm();
            });
            input.addEventListener('change', function() {
                input.dataset.touched = 'true'; 
                validateForm();
            });
        });

        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    }

    function validateFieldAdd(input) {
        if (input.dataset.touched === 'false') {
            return true; 
        }

        const value = input.value.trim();
        const inputId = input.id;
        let isValid = true;

        if (input.hasAttribute('required') && value === '') {
            isValid = false;
        }

        if (inputId === 'addNameCar') {
            const regex = /^[a-zA-Z0-9\s]+$/;
            if (!regex.test(value)) {
                isValid = false;
            }
        }

        if (inputId === 'addYearCar') {
            const year = parseInt(value, 10);
            if (isNaN(year) || year < 1990 || year > 2025) {
                isValid = false;
            }
        }

        if (inputId === 'addCvCar') {
            const number = parseFloat(value);
            if (isNaN(number) || number < 1) {
                isValid = false;
            }
        }

        if (inputId === 'addPriceCar') {
            const number = parseFloat(value);
            if (isNaN(number) || number < 1) {
                isValid = false;
            }
        }

        if (inputId === 'addFormFile') {
            if (input.files.length === 0) {
                isValid = false;
            } else {
                const file = input.files[0];
                const allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
                const maxSize = 2048 * 1024; // 2048 KB in bytes
    
                if (!allowedMimes.includes(file.type)) {
                    isValid = false;
                }
    
                if (file.size > maxSize) {
                    isValid = false;
                }
            }
        }

        if (isValid) {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
        } else {
            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
        }

        return isValid;
    }

    ////////////////// Add car with gallery image //////////////////
    const addImageButton = document.getElementById('addImage');
    const extraImagesDiv = document.getElementById('addExtraImages');
    const mainImageInput = document.getElementById('addFormFile');

    if (!addImageButton || !extraImagesDiv || !mainImageInput) {
        console.error("No se encontraron los elementos necesarios en el DOM.");
        return;
    }

    mainImageInput.addEventListener('change', function () {
        addImageButton.disabled = !this.files.length;
        
    });

    addImageButton.addEventListener('click', function () {
        addImageButton.disabled = true; 

        const newInputDiv = document.createElement('div');
        newInputDiv.classList.add('col-12', 'mt-2', 'image-input');
        const newInput = document.createElement('input');
        newInput.classList.add('form-control');
        newInput.type = 'file';
        newInput.name = 'images[]';
        newInput.accept = 'image/*';
        newInput.required = true;

        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-danger', 'mt-2');
        removeButton.textContent = 'Eliminar';
        

        removeButton.addEventListener('click', function () {
            newInputDiv.remove();
            checkButtonState();
        });

        newInput.addEventListener('change', function () {
            checkButtonState();
        });

        newInputDiv.appendChild(newInput);
        newInputDiv.appendChild(removeButton);
        extraImagesDiv.appendChild(newInputDiv);

        checkButtonState();
    });


    function checkButtonState() {
        const extraInputs = extraImagesDiv.querySelectorAll('input[type="file"]');

        let count = 0;
        let countInputs = 0;
        extraInputs.forEach(input => {
            countInputs++;
            if (input.files.length > 0) {
                count++;
            }
        });

        if(count == countInputs){
            addImageButton.disabled = false;
        }else{
            addImageButton.disabled = true;
        }
            
    
        
    }

    document.getElementById('form-addCar').addEventListener('submit', function (event) {
        const extraInputs = extraImagesDiv.querySelectorAll('input[type="file"]');
        let isValid = true;
        extraInputs.forEach(function (input) {
            if (!input.files || input.files.length === 0) {
                input.setCustomValidity('Por favor, selecciona una imagen.');
                isValid = false;
            } else {
                input.setCustomValidity('');
            }
        });
        if (!isValid) {
            event.preventDefault();
        }
    });
    ////////////////// Edit car with gallery image //////////////////
    const editAddImageButton = document.getElementById('editAddImage');
    const editExtraImagesDiv = document.getElementById('editExtraImages');
    const editMainImageInput = document.getElementById('editFormFile');

    if (!editAddImageButton || !editExtraImagesDiv || !editMainImageInput) {
        console.error("No se encontraron los elementos necesarios en el DOM.");
        return;
    }

    editMainImageInput.addEventListener('change', function () {
        checkEditButtonState();
    });

    editAddImageButton.addEventListener('click', function () {
        editAddImageButton.disabled = true;

        const newInputDiv = document.createElement('div');
        newInputDiv.classList.add('col-12', 'mt-2', 'image-input');
        const newInput = document.createElement('input');
        newInput.classList.add('form-control');
        newInput.type = 'file';
        newInput.name = 'editImages[]';
        newInput.accept = 'image/*';
        newInput.required = true;

        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-danger', 'mt-2');
        removeButton.textContent = 'Eliminar';

        removeButton.addEventListener('click', function () {
            newInputDiv.remove();
            checkEditButtonState();
        });

        newInput.addEventListener('change', function () {
            checkEditButtonState();
        });

        newInputDiv.appendChild(newInput);
        newInputDiv.appendChild(removeButton);
        editExtraImagesDiv.appendChild(newInputDiv);

        checkEditButtonState();
    });

    function checkEditButtonState() {
        const extraInputs = editExtraImagesDiv.querySelectorAll('input[name="editImages[]"]');

        let count = 0;
        let countInputs = 0;
        extraInputs.forEach(input => {
            countInputs++;
            if (input.files.length > 0) {
                count++;
            }
        });

        if (count == countInputs || editMainImageInput.files.length > 0) {
            editAddImageButton.disabled = false;
        } else {
            editAddImageButton.disabled = true;
        }
    }
});

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
        }).then(function (result) {
            if (result) {
                fetch(deleteRoute, {  
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

////////////////// Edit Car //////////////////

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
        let carGallery = JSON.parse(this.getAttribute("data-gallery"));
        let carImgGallery = JSON.parse(this.getAttribute('data-gallery-img'));

        document.getElementById('editIdCar').value = id;
        document.getElementById('editNameCar').value = name;
        document.getElementById('editBrandCar').value = brandId;
        document.getElementById('editTypeCar').value = typeId;
        document.getElementById('editColorCar').value = colorId;
        document.getElementById('editYearCar').value = year;
        document.getElementById('editCvCar').value = horsepower;
        document.getElementById('editPriceCar').value = price;
        document.getElementById('mainImg').src = mainImg;
        sale == 1 ? document.getElementById('editOfferCar').checked = true : document.getElementById('editOfferCar').checked = false;

        const galleryImagesContainer = document.getElementById("galleryImages");
        galleryImagesContainer.innerHTML = "";

        let galleryContent = "";

        for (let i = 0; i < Math.max(carGallery.length, carImgGallery.length); i++) {
            const imageUrl = carGallery[i] || "";
            const imgValue = carImgGallery[i] || "";

            galleryContent += `
                <div class="row g-3 image-block"> <!-- Contenedor común -->
                    <div class="col-md-6 col-12">
                        <img src="${imageUrl}" class="w-100" alt="Imagen del coche">
                        <input type="hidden" value="${imgValue}" name="img${i + 1}">
                    </div>
                    <div class="col-md-6 col-12 d-flex flex-column align-items-center justify-content-center">
                        <label for="galleryFormFile${i + 1}" class="form-label">Cambiar imagen</label>
                        <input class="form-control" type="file" id="galleryFormFile${i + 1}" name="fileImg${i + 1}" accept="image/*">
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona una imagen.</div>
                        <button type="button" class="btn btn-danger btn-sm mt-2 delete-image-gallery" data-img-name="${imgValue}">Eliminar</button>
                    </div>
                </div>`;
            }

        galleryImagesContainer.innerHTML = galleryContent;

        setupFormValidationEdit(document.getElementById('form-editCar'), document.querySelector('#form-editCar button[type="submit"]')); // Initialize validation
    });
});

document.getElementById('galleryImages').addEventListener('click', function (e) {
    if (e.target && e.target.classList.contains('delete-image-gallery')) {
        console.log('click en eliminar');

        const imgName = e.target.getAttribute('data-img-name');
        const imageBlock = e.target.closest('.image-block'); 

        imageBlock.remove();

        const deletedImagesInput = document.createElement('input');
        deletedImagesInput.type = 'hidden';
        deletedImagesInput.name = 'deleted_images[]';
        deletedImagesInput.value = imgName;
        document.getElementById('form-editCar').appendChild(deletedImagesInput);
    }
});

function setupFormValidationEdit(form, submitButton) {
    const inputs = form.querySelectorAll('input, select');

    function validateForm() {
        let formIsValid = true;
        inputs.forEach(input => {
            if (!validateFieldEdit(input)) {
                formIsValid = false;
            }
        });
        submitButton.disabled = !formIsValid;
    }

    inputs.forEach(input => {
        input.addEventListener('input', validateForm);
        input.addEventListener('change', validateForm);
    });

    inputs.forEach(validateFieldEdit);
    validateForm();

    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });
}

function validateFieldEdit(input) {
    const value = input.value.trim();
    const inputId = input.id;
    let isValid = true;

    if (input.hasAttribute('required') && value === '') {
        isValid = false;
    }

    if (inputId === 'editNameCar') {
        const regex = /^[a-zA-Z0-9\s]+$/;
        if (!regex.test(value)) {
            isValid = false;
        }
    }

    if (inputId === 'editYearCar') {
        const year = parseInt(value, 10);
        if (isNaN(year) || year < 1990 || year > 2025) {
            isValid = false;
        }
    }

    if (inputId === 'editCvCar') {
        const number = parseFloat(value);
        if (isNaN(number) || number < 1) {
            isValid = false;
        }
    }

    if (inputId === 'editPriceCar') {
        const number = parseFloat(value);
        if (isNaN(number) || number < 1) {
            isValid = false;
        }
    }

    if (inputId === 'editFormFile') {
        const mainImg = document.getElementById('mainImg');
        if (mainImg && mainImg.src) {
            isValid = true;
        } else if (value === '') {
            isValid = false;
        }
    }

    if (isValid) {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
    } else {
        input.classList.remove('is-valid');
        input.classList.add('is-invalid');
    }

    return isValid;
}

document.getElementById('editSubmit').addEventListener('click', function (event) {
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
    }).then(function (result) {
        if (result) {
            document.getElementById('form-editCar').submit();
        }
    });

    if (formEditCar) {
        const editCarModal = document.getElementById('editCar');
        editCarModal.addEventListener('shown.bs.modal', function () {
            const inputs = formEditCar.querySelectorAll('input, select');
            inputs.forEach(input => {
                validateField(input);
            });
            validateForm(); 
        });
    }
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