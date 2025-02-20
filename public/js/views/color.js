const delete_car = document.querySelectorAll('.delete-color');

delete_car.forEach(btn => {
    btn.addEventListener('click', function (e) {
        let id = this.getAttribute('data-color-id');
        //console.log(id);
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
                    fetch("/admin/delete_color", {  // No pasamos ID en la URL
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