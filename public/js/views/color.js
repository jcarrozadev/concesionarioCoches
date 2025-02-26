const delete_car = document.querySelectorAll('.delete-color');

delete_car.forEach(btn => {
    btn.addEventListener('click', function (e) {
        let id = this.getAttribute('data-color-id');
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        swal({
            title: "¿Estás seguro de eliminar este color?",
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
                    fetch(deleteRoute, {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            "X-CSRF-TOKEN": token
                        },
                        body: JSON.stringify({ color_id: id }) 
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

// Edit color
const editColor = document.querySelectorAll('.edit-btn');
editColor.forEach(btn => {
    btn.addEventListener('click', function (e) {
        let id = this.getAttribute('data-id');
        let name = this.getAttribute('data-name');
        let color = this.getAttribute('data-color');

        let input = document.getElementById('name');
        let inputID = document.getElementById('id');
        let inputColor = document.getElementById('color');

        inputID.value = id;
        input.value = name;
        inputColor.value = color;

    });
});

///////////////////////////////////////////////////////////////// Validations /////////////////////////////////////////////////////////////////
const nameForm = document.getElementById("addColorName");
const submitButton = document.getElementById("btn-addcolor");

/**
 * Validation for name input
 * @returns 
 */
function validateName() {

    const specialChars = /[!@#$%^&*(),.?":{}|<>]/g;
    
    if (nameForm.value === "") {
        nameForm.classList.remove("is-valid", "is-invalid"); // Dont show error if empty
        return false;
    }

    if (nameForm.value.trim() === "" || specialChars.test(nameForm.value)) {
        nameForm.classList.add("is-invalid");
        nameForm.classList.remove("is-valid");
        return false;
    } else {
        nameForm.classList.add("is-valid");
        nameForm.classList.remove("is-invalid");
        return true;
    }
}

/**
 * Check if form is valid to enable submit button 
 */
function checkFormValidity() {
    submitButton.disabled = !(validateName());
}

nameForm.addEventListener("input", function () {
    validateName();
    checkFormValidity();
});

/////////// Validations Edit Color ///////////
const nameEditForm = document.getElementById("name");
const submitEditButton = document.getElementById("btn-editcolor");

/**
 * Validation for name input
 * @returns 
 */
function validateNameEdit() {

    const specialChars = /[!@#$%^&*(),.?":{}|<>]/g;
    
    if (nameEditForm.value === "") {
        nameEditForm.classList.remove("is-valid", "is-invalid"); // Dont show error if empty
        return false;
    }

    if (nameEditForm.value.trim() === "" || specialChars.test(nameEditForm.value)) {
        nameEditForm.classList.add("is-invalid");
        nameEditForm.classList.remove("is-valid");
        return false;
    } else {
        nameEditForm.classList.add("is-valid");
        nameEditForm.classList.remove("is-invalid");
        return true;
    }
}

/**
 * Check if form is valid to enable submit button 
 */
function checkFormValidityEdit() {
    submitEditButton.disabled = !(validateNameEdit());
}

nameEditForm.addEventListener("input", function () {
    validateNameEdit();
    checkFormValidityEdit();
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
                document.getElementById('form-editColor').submit();
            }
        });
});

document.addEventListener('DOMContentLoaded', function() {

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
    })();
});