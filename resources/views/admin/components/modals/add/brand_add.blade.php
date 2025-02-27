<div id="addBrand" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir marca de coche</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="form-addBrand" class="row g-3 needs-validation" action="{{ route('addBrand') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="addBrandName">Marca de coche <span class="modal_required">*</span></label>
                        <input id="addBrandName" name="name" class="form-control" type="text" placeholder="Añade la marca de coche" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, introduce el nombre de la marca.</div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-changes" id="btn-addbrand">Añadir Marca</button>
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
