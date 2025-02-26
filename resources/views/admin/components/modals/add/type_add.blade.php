<div id="addType" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir tipo de coche</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="formAddType" class="row g-3 needs-validation" action="{{ route('addType') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="addTypeName">Tipo de coche *</label>
                        <input id="addTypeName" name="name" class="form-control" type="text" placeholder="Añade el tipo de coche" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, introduce el tipo de coche.</div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-changes" id="btn-addtype">Añadir Tipo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>