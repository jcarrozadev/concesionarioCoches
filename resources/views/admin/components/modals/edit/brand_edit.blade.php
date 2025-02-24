<div id="editBrand" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="form-editBrand" class="row g-3 needs-validation" action="{{ route('editBrand') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" novalidate>
                    @method('PUT')
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="editBrandName">Marca de coche *</label>
                        <input id="id" name="id" class="form-control" type="text" value="" hidden>
                        <input id="editBrandName" name="name" class="form-control" type="text" value="" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Esta marca contiene un caracter no permitido.</div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-changes" id="btn-edit">Editar Marca</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
