<div class="filter">
    <div class="row">
        <div class="col-md-2 mt-2">
            <select class="form-select">
                <option selected hidden disabled>Brand</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 mt-2">
            <input type="text" class="form-control" placeholder="Model">
        </div>
        <div class="col-md-2 mt-2">
            <select class="form-select">
                <option selected hidden disabled>Color</option>
                @foreach ($colors as $color)
                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <div class="double_range_slider_box">
                <label for="range_track_price">Precio</label>
                <div class="double_range_slider">
                    
                    <span class="range_track" id="range_track_price"></span>
                    <input class="slider_range" id="min_range_price" type="range" min="0" max="100" value="0" step="0"/>
                    <input class="slider_range" id="max_range_price" type="range" min="0" max="100" value="20" step="0"/>

                    <div class="minvalue" id="minvalue_price"></div>
                    <div class="maxvalue" id="maxvalue_price"></div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="double_range_slider_box">
                <label for="range_track_cv">CV</label>
                <div class="double_range_slider">
                    
                    <span class="range_track" id="range_track_cv"></span>
                    <input class="slider_range" id="min_range_cv" type="range" min="0" max="100" value="0" step="0"/>
                    <input class="slider_range" id="max_range_cv" type="range" min="0" max="100" value="20" step="0"/>

                    <div class="minvalue" id="minvalue_cv"></div>
                    <div class="maxvalue" id="maxvalue_cv"></div>
                </div>
            </div>
        </div>

        <div class="col-md-2 mt-2 d-flex justify-content-end">
            <button class="btn btn-warning">Restablecer</button>
        </div>
    </div>
</div>