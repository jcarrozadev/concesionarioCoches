<div id="addColor" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir color de coches</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="formAddColor" class="row g-3 needs-validation" action="{{ route(name: 'addColor') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="addColorName">Nombre del color <span class="modal_required">*</span></label>
                        <input id="addColorName" name="name" class="form-control" type="text" placeholder="Añade el nombre del color" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, introduce el nombre del color.</div>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="addColorHex">Color <span class="modal_required">*</span></label>
                        <input type="color" class="form-control form-control-color" id="hex" name="hex" value="#000000" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona un color.</div>
                    </div>        
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-changes" id="btn-addcolor">Añadir Color</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
