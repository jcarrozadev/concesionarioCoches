<div id="editColor" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar color</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="form-editColor" class="row g-3 needs-validation" action="{{ route('editColor') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data" novalidate>
                    @method('PUT')
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="editColorName">Nombre del color *</label>
                        <input id="id" name="id" class="form-control" type="text" hidden>
                        <input id="name" name="name" class="form-control" type="text" placeholder="" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, introduce el nombre del color.</div>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="editColorHex">Color *</label>
                        <input type="color" class="form-control form-control-color" id="color" name="hex" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona un color.</div>
                    </div>        
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-changes" id="btn-editcolor">Editar Color</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
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
</script>
