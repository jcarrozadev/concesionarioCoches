//Delete Type
const deleteType = document.querySelectorAll('.delete-btn');
let token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
deleteType.forEach(btn => {
    btn.addEventListener('click', function (e) {
        let id = this.getAttribute('data-type-id');
        let name = this.getAttribute('data-type-name');
        

        //Take cars to show information to user
        fetch(takeCars, {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-TOKEN": token
            },
            body: JSON.stringify({ type_id: id }) 
        })
        .then(response => response.json()) 
        .then(data => {
            
            if (data.success) {
                
                let carsList = data.carsDeleted.length > 0 
                    ? data.carsDeleted.map(car => `${car.type_name} ${car.name}`).join(" | ")
                    : "No hay ningún coche asociado a este tipo.";

                swal({
                    title: `¿Estás seguro que quieres eliminar el tipo ${name}?`,
                    content: {
                        element: "div",
                        attributes: {
                            innerHTML: `
                                <p style="text-align: center; margin: 1px 0;">
                                    ${data.carsDeleted.length > 0 
                                        ? "Este tipo tiene los siguientes coches asociados:" 
                                        : "Este tipo no tiene coches asociados."}
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
                                body: JSON.stringify({ type_id: id }) 
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

// Update type
const editBtns = document.querySelectorAll('.edit-btn');
editBtns.forEach(btn => {
    btn.addEventListener('click', function (e) {
        
        let id = this.getAttribute('data-id');
        let name = this.getAttribute('data-name');

        document.getElementById('editId').value = id;
        document.getElementById('editTypeName').value = name;

    });
});




// Bootstrap validations 
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
