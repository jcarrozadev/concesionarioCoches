<div id="addCar" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir marca de coche</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="form-addCar" class="row g-3 needs-validation" action="" method="post" accept-charset="UTF-8" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="nameCar">Nombre del coche *</label>
                        <input id="nameCar" name="nameCar" class="form-control" type="text" placeholder="Añade el tipo de coche" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, introduce el nombre del coche.</div>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="brandCar">Marca del coche *</label>
                        <select id="brandCar" class="form-select" name="brandCar" required>
                            <option value="">Selecciona una marca</option>
                            <option value="1">BMW</option>
                            <option value="2">Mercedes</option>
                            <option value="3">Seat</option>
                        </select>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona una marca de coche.</div>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="typeCar">Tipo del coche *</label>
                        <select id="typeCar" class="form-select" name="typeCar" required>
                            <option value="">Selecciona un tipo</option>
                            <option value="1">SUV</option>
                            <option value="2">Deportivo</option>
                            <option value="3">Todoterreno</option>
                        </select>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona un tipo de coche.</div>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="colorCar">Color del coche *</label>
                        <select id="colorCar" class="form-select" name="colorCar" required>
                            <option value="">Selecciona un color</option>
                            <option value="1">Rojo</option>
                            <option value="2">Verde</option>
                            <option value="3">Azul</option>
                        </select>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona un color de coche.</div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Añadir Coche</button>
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
    })()
</script>

