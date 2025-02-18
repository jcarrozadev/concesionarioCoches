<div id="addColor" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir color de coches</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="form-addColor" action="" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="typeName">Nombre del color *</label>
                        <input class="form-control" type="text" placeholder="Añade el nombre del color">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" for="typeName">Color *</label>
                        <input type="color" class="form-control w-25" id="colorHex" name="codigo_hex" value="#000000" required> 
                    </div>        
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('colorHex').addEventListener('input', function(event) {
        console.log(document.getElementById('colorHex').value);
        
    });
</script>