import ColorValidator from '/js/ColorValidator.js';
////////////////////////////////////////////////////////////////// Delete color
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

///////////////////////////////////////////////////////////////////////////////////////// Edit color
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
document.addEventListener('DOMContentLoaded', function() {
    new ColorValidator('#formAddColor', '#btn-addcolor', '#addColorName');
    new ColorValidator('#form-editColor', '#btn-editcolor', '#name');
});

document.getElementById('btn-editcolor').addEventListener('click', function(event) {
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

    /////// Bootstrap validation
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