@if ($action == 'editBrand' || $action == 'editType' || $car_name)
    <button class="btn btn-secondary edit-btn" data-bs-toggle="modal" data-bs-target="#{{ $action }}" data-id="{{ $id }}" data-name="{{ $name }}">Editar</button>
@endif
@if ($action == 'editColor')
    <button class="btn btn-secondary edit-btn" data-bs-toggle="modal" data-bs-target="#{{ $action }}" data-id="{{ $id }}" data-name="{{ $name }}" data-color="{{ $hex }}">Editar</button>
@endif

