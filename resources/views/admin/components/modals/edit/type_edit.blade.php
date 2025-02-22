<div id="editType" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar tipo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="form-editType" class="row g-3 needs-validation" action="{{ route('updateType') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
                    <input id="editId" name="id" class="form-control" type="hidden">

                    <div class="col-12">
                        <label class="form-label" for="editTypeName">Tipo de coche *</label>
                        <input id="editTypeName" name="name" class="form-control" type="text" placeholder="Añade el tipo de coche" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, introduce el tipo de coche.</div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Editar Tipo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
