//Delete brand
const deleteBrand = document.querySelectorAll('.delete-btn');

let token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
deleteBrand.forEach(btn => {
    btn.addEventListener('click', function (e) {
        let id = this.getAttribute('data-brand-id');
        let name = this.getAttribute('data-brand-name');
        

        //Take cars to show information to user
        fetch(takeCars, {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-TOKEN": token
            },
            body: JSON.stringify({ brand_id: id }) 
        })
        .then(response => response.json()) 
        .then(data => {
            
            if (data.success) {
                
                let carsList = data.carsDeleted.length > 0 
                    ? data.carsDeleted.map(car => `${car.brand_name} ${car.name}`).join(" | ")
                    : "No hay ningún coche asociado a esta marca.";

                swal({
                    title: `¿Estás seguro que quieres eliminar la marca ${name}?`,
                    content: {
                        element: "div",
                        attributes: {
                            innerHTML: `
                                <p style="text-align: center; margin: 1px 0;">
                                    ${data.carsDeleted.length > 0 
                                        ? "Esta marca tiene los siguientes coches asociados:" 
                                        : "Esta marca no tiene coches asociados."}
                                </p>
                                <p style="text-align: center; font-weight: bold; margin: 1px 0;">
                                    ${carsList.replace(/\n/g, "<br>")}
                                </p>`
                        }
                    },
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
                    customClass: {
                        popup: 'swal-custom-popup',
                        title: 'swal-custom-title'
                    }
                    }).then(function(result) {
                        if (result) {
                            fetch(deleteRoute, {
                                method: "POST",
                                headers: {
                                    'Content-Type': 'application/json',
                                    "X-CSRF-TOKEN": token
                                },
                                body: JSON.stringify({ brand_id: id }) 
                            })
                            .then(response => response.json()) 
                            .then(data => {
                                if (data.success) {
                                    swal("¡Eliminada!", data.success, "success")
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
            } else if (data.error) {
                swal("Error", data.error, "error");
            }
        })
        .catch(error => {
            swal("Error", "Hubo un problema en el servidor.", "error");
            console.error("Error:", error);
        });

    });
});

//Edit brand
const editBrand = document.querySelectorAll('.edit-btn');
editBrand.forEach(btn => {
    btn.addEventListener('click', function (e) {
        let id = this.getAttribute('data-id');
        let name = this.getAttribute('data-name');

        let input = document.getElementById('editBrandName');
        let inputID = document.getElementById('id');

        inputID.value = id;
        input.value = name;

    });
});

/////////// Validations Create Brand ///////////
const nameForm = document.getElementById("addBrandName");
const submitButton = document.getElementById("btn-addbrand");

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

/////////// Validations Edit Brand ///////////
const nameEditForm = document.getElementById("editBrandName");
const submitEditButton = document.getElementById("btn-editbrand");

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
