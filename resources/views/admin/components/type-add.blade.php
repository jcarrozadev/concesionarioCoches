<div id="addType" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir tipo de coche</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="form-addType" action="" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                    @csrf
                    <label class="form-label" for="typeName">Tipo de coche *</label>
                    <input class="form-control" type="text" placeholder="Añade el tipo de coche">
                </form>
            </div>
        </div>
    </div>
</div>