<div id="editCar" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar coche</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="form-editCar" class="row g-3 needs-validation" action="{{ route('updateCar') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editIdCar" name="id" value="">
                    <div class="col-12">
                        <label class="form-label" for="editNameCar">Nombre del coche *</label>
                        <input id="editNameCar" name="name" class="form-control" type="text" placeholder="Añade el nombre del coche" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, introduce el nombre del coche.</div>
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label" for="editBrandCar">Marca del coche *</label>
                        <select id="editBrandCar" class="form-select" name="brand_id" required>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona una marca de coche.</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="editTypeCar">Tipo del coche *</label>
                        <select id="editTypeCar" class="form-select" name="type_id" required>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona un tipo de coche.</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="editColorCar">Color del coche *</label>
                        <select id="editColorCar" class="form-select" name="color_id" required>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona un color de coche.</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="editCvCar">CV del coche *</label>
                        <input id="editCvCar" name="horsepower" class="form-control" type="number" step="0.01" min="1" placeholder="Añade los CV del coche" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, introduce los CV del coche.</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="editYearCar">Año del coche *</label>
                        <input id="editYearCar" name="year" class="form-control" type="number" min="1900" max="2025" placeholder="Añade el año del coche" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, introduce un año válido.</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="editPriceCar">Precio del coche *</label>
                        <input id="editPriceCar" name="price" step="0.01" class="form-control" type="number" min="1" placeholder="Añade el precio del coche" required>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, introduce un precio válido.</div>
                    </div>

                    <div class="col-12">
                        <input type="hidden" value="0" name="sale">
                        <input class="form-check-input" type="checkbox" value="1" id="editOfferCar" name="sale">
                        <label class="form-check-label" for="editOfferCar">
                            En oferta
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <p>Imagen actual principal</p>
                        <img id="mainImg" src="" class="w-100" alt="">
                    </div>
                    <div class="col-md-6 col-12 d-flex flex-column align-items-center justify-content-center">
                        <label for="editFormFile" class="form-label">Imagen principal del coche</label>
                        <input class="form-control" type="file" id="editFormFile" name="main_img" accept="image/*">
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona una imagen.</div>
                    </div>
                    
                    {{-- <hr>
                    <div class="col-md-6 col-12">
                        <img src="img/6kfondo.jpeg" class="w-100" alt="">
                    </div>
                    <div class="col-md-6 col-12 d-flex flex-column align-items-center justify-content-center">
                        <label for="editFormFile" class="form-label">Imagen del coche</label>
                        <input class="form-control" type="file" id="editFormFile" name="formFile" accept="image/*">
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Por favor, selecciona una imagen.</div>
                    </div> --}}
                    {{-- <hr class="mt-3"> --}}
                    <div id="galleryImages" class="row g-3">
                        
                    </div>
                    <div id="editExtraImages"></div>

                    <div class="col-12">
                        <button type="button" class="btn btn-success" id="editAddImage"><strong>+</strong> Añadir otra imagen</button>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" id="editSubmit" class="btn btn-changes">Editar Coche</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>