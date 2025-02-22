@if ($car_name)
    <button class="btn btn-secondary edit-btn" data-bs-toggle="modal" data-bs-target="#{{ $action }}" data-id="{{ $car_id }}" data-name="{{ $car_name }}" data-brand-id="{{ $car_brand_id }}" data-type-id="{{ $car_type_id }}" data-color-id="{{ $car_color_id }}" data-year="{{ $car_year }}" data-horsepower="{{ $car_horsepower }}" data-price="{{ $car_price }}" data-mainImg="{{ $car_main_img }}" data-sale={{ $car->sale }}>Editar</button>

@else
    <button class="btn btn-secondary edit-btn" data-bs-toggle="modal" data-bs-target="#{{ $action }}" data-id="{{ $id }}" data-name="{{ $name }}">Editar</button>
@endif
