<div id="addCar" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Vehículo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="form-addCar" class="row g-3 needs-validation" action="{{ route(name: 'addCar') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="addNameCar">Nombre del modelo <span class="modal_required">*</span></label>
                        <input id="addNameCar" name="name" class="form-control" type="text" placeholder="Añade el nombre del vehículo" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, introduce el nombre del modelo.</div>
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label" for="addBrandCar">Marca <span class="modal_required">*</span></label>
                        <select id="addBrandCar" class="form-select" name="brand_id" required>
                            <option value="" hidden selected disabled>Selecciona una marca</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona una marca de vehículo.</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="addTypeCar">Tipo de vehículo <span class="modal_required">*</span></label>
                        <select id="addTypeCar" class="form-select" name="type_id" required>
                            <option value="" hidden selected disabled>Selecciona un tipo</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona un tipo de vehículo.</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="addColorCar">Color del coche <span class="modal_required">*</span></label>
                        <select id="addColorCar" class="form-select" name="color_id" required>
                            <option value="" hidden selected disabled>Selecciona un color</option>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona un color de vehículo.</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="addCvCar">CV del coche <span class="modal_required">*</span></label>
                        <input id="addCvCar" name="horsepower" class="form-control" type="number" min="1" placeholder="Añade los CV del vehículo" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, introduce los CV del vehículo.</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="addYearCar">Año del coche <span class="modal_required">*</span></label>
                        <input id="addYearCar" name="year" class="form-control" type="number" min="1900" max="2025" placeholder="Añade el año del vehículo" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, introduce un año válido.</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="addPriceCar">Precio del coche <span class="modal_required">*</span></label>
                        <input id="addPriceCar" name="price" class="form-control" type="number" min="1" placeholder="Añade el precio del vehículo" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, introduce un precio válido.</div>
                    </div>

                    <div class="col-12">
                        <input class="form-check-input" type="checkbox" value="1" id="addOfferCar" name="sale">
                        <label class="form-check-label" for="addOfferCar">
                            En oferta
                        </label>
                    </div>

                    <div class="col-12">
                        <label for="addFormFile" class="form-label">Seleccione la imagen principal del vehículo <span class="modal_required">*</span></label>
                        <input class="form-control" type="file" id="addFormFile" name="main_img" accept="image/*" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona una imagen.</div>
                    </div>

                    <div id="addExtraImages"></div>

                    <div class="col-12">
                        <button type="button" class="btn btn-success" id="addImage" disabled><strong>+</strong> Añadir otra imagen</button>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-changes">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
