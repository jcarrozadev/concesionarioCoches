<div id="editCar" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar coche</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="form-editCar" class="row g-3 needs-validation" action="" method="post" accept-charset="UTF-8" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="editNameCar">Nombre del coche *</label>
                        <input id="editNameCar" name="nameCar" class="form-control" type="text" placeholder="Añade el nombre del coche" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, introduce el nombre del coche.</div>
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label" for="editBrandCar">Marca del coche *</label>
                        <select id="editBrandCar" class="form-select" name="brandCar" required>
                            <option value="">Selecciona una marca</option>
                            <option value="1">BMW</option>
                            <option value="2">Mercedes</option>
                            <option value="3">Seat</option>
                        </select>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona una marca de coche.</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="editTypeCar">Tipo del coche *</label>
                        <select id="editTypeCar" class="form-select" name="typeCar" required>
                            <option value="">Selecciona un tipo</option>
                            <option value="1">SUV</option>
                            <option value="2">Deportivo</option>
                            <option value="3">Todoterreno</option>
                        </select>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona un tipo de coche.</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="editColorCar">Color del coche *</label>
                        <select id="editColorCar" class="form-select" name="colorCar" required>
                            <option value="">Selecciona un color</option>
                            <option value="1">Rojo</option>
                            <option value="2">Verde</option>
                            <option value="3">Azul</option>
                        </select>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona un color de coche.</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="editCvCar">CV del coche *</label>
                        <input id="editCvCar" name="cvCar" class="form-control" type="number" min="1" placeholder="Añade los CV del coche" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, introduce los CV del coche.</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="editYearCar">Año del coche *</label>
                        <input id="editYearCar" name="yearCar" class="form-control" type="number" min="1900" max="2025" placeholder="Añade el año del coche" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, introduce un año válido.</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="editPriceCar">Precio del coche *</label>
                        <input id="editPriceCar" name="priceCar" class="form-control" type="number" min="1" placeholder="Añade el precio del coche" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, introduce un precio válido.</div>
                    </div>

                    <div class="col-12">
                        <input class="form-check-input" type="checkbox" value="1" id="editOfferCar" name="offerCar">
                        <label class="form-check-label" for="editOfferCar">
                            En oferta
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <p>Imagen actual principal</p>
                        <img src="img/6kfondo.jpeg" class="w-100" alt="">
                    </div>
                    <div class="col-md-6 col-12 d-flex flex-column align-items-center justify-content-center">
                        <label for="editFormFile" class="form-label">Imagen principal del coche</label>
                        <input class="form-control" type="file" id="editFormFile" name="formFile" accept="image/*" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona una imagen.</div>
                    </div>
                    <hr>
                    <div class="col-md-6 col-12">
                        <img src="img/6kfondo.jpeg" class="w-100" alt="">
                    </div>
                    <div class="col-md-6 col-12 d-flex flex-column align-items-center justify-content-center">
                        <label for="editFormFile" class="form-label">Imagen del coche</label>
                        <input class="form-control" type="file" id="editFormFile" name="formFile" accept="image/*">
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona una imagen.</div>
                    </div>

                    <div id="editExtraImages"></div>

                    <div class="col-12">
                        <button type="button" class="btn btn-success" id="editAddImage"><strong>+</strong> Añadir otra imagen</button>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Editar Coche</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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

    document.addEventListener('DOMContentLoaded', function () {
        const addImageButton = document.getElementById('editAddImage');
        const extraImagesDiv = document.getElementById('editExtraImages');

        if (!addImageButton || !extraImagesDiv) {
            console.error("No se encontraron los elementos necesarios en el DOM.");
            return;
        }

        // Función para habilitar o deshabilitar el botón de añadir imagen
        const toggleAddImageButton = () => {
            const fileInputs = extraImagesDiv.querySelectorAll('input[type="file"]');
            const lastInput = fileInputs[fileInputs.length - 1];
            if (lastInput && lastInput.files && lastInput.files.length > 0) {
                addImageButton.disabled = false; // Habilitar el botón si hay un archivo seleccionado
            } else {
                addImageButton.disabled = true; // Deshabilitar el botón si no hay archivo seleccionado
            }
        };

        // Evento para añadir imágenes adicionales
        addImageButton.addEventListener('click', function () {
            // Crear nuevo contenedor para el input
            let newInputDiv = document.createElement('div');
            newInputDiv.classList.add('col-12', 'mt-2', 'image-input');

            // Crear nuevo input de imagen
            let newInput = document.createElement('input');
            newInput.classList.add('form-control');
            newInput.type = 'file';
            newInput.name = 'formFile[]';
            newInput.accept = 'image/*';
            newInput.required = true;

            // Evento para habilitar el botón cuando se seleccione un archivo
            newInput.addEventListener('change', toggleAddImageButton);

            // Botón para eliminar la imagen
            let removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.classList.add('btn', 'btn-danger', 'mt-2');
            removeButton.innerHTML = 'Eliminar';

            // Evento para eliminar el input
            removeButton.addEventListener('click', function () {
                newInputDiv.remove();
                toggleAddImageButton(); // Verificar si el botón debe habilitarse después de eliminar un input
            });

            // Agregar input y botón al nuevo div
            newInputDiv.appendChild(newInput);
            newInputDiv.appendChild(removeButton);

            // Agregar el div al contenedor de imágenes extra
            extraImagesDiv.appendChild(newInputDiv);

            // Deshabilitar el botón después de agregar un nuevo input
            addImageButton.disabled = true;
        });

        // Validación de los campos de archivo adicionales
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
</script>
