@extends('admin.layout')

@section('title')
    AllStarsAutos | Panel Vehículos
@endsection

@section('content')
    <div class="containerTable">
        <div class="title">
            <h3>Vehículos</h3>
        </div>
        @include('admin.components.button_add', ['action' => 'addCar'])
        <div class="table-wrapper">
            <table id="table" class="display text-center datatable">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Modelo</th>
                        <th class="text-center">Marca</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Color</th>
                        <th class="text-center">Año</th>
                        <th class="text-center">CV</th>
                        <th class="text-center">Precio</th>
                        <th class="text-center">Oferta</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    <tr>
                        <th>
                            <input type="text" class="filter-input" placeholder="Buscar...">
                        </th>
                        <th>
                            <input type="text" class="filter-input" placeholder="Buscar...">
                        </th>
                        <th>
                            <input type="text" class="filter-input" placeholder="Buscar...">
                        </th>
                        <th>
                            <input type="text" class="filter-input" placeholder="Buscar...">
                        </th>
                        <th>
                            <input type="text" class="filter-input" placeholder="Buscar...">
                        </th>
                        <th>
                            <input type="text" class="filter-input" placeholder="Buscar...">
                        </th>
                        <th>
                            <input type="text" class="filter-input" placeholder="Buscar...">
                        </th>
                        <th>
                            <input type="text" class="filter-input" placeholder="Buscar...">
                        </th>
                        <th>
                            <input type="text" class="filter-input" placeholder="Buscar...">
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cars as $car)
                        <tr>
                            <td>{{ $car->id }}</td>
                            <td>{{ $car->name }}</td>
                            <td>{{ $car->brand_name }}</td>
                            <td>{{ $car->type_name }}</td>
                            <td>{{ $car->color_name }}</td>
                            <td>{{ $car->year }}</td>
                            <td>{{ $car->horsepower }} CV</td>
                            <td>{{ $car->price }} €</td>
                            <td>
                                @if ($car->sale == 1)
                                    Si
                                @else
                                    No
                                @endif
                            </td>
                            <td id="buttonFields">
                                @include('admin.components.button_edit', [
                                    'action' => 'editCar',
                                    'car_id' => $car->id,
                                    'car_name' => $car->name,
                                    'car_brand_id' => $car->brand_id,
                                    'car_type_id' => $car->type_id,
                                    'car_color_id' => $car->color_id,
                                    'car_year' => $car->year,
                                    'car_horsepower' => $car->horsepower,
                                    'car_price' => $car->price,
                                    'car_main_img' => url('img/' . $car->main_img),
                                    'car_sale' => $car->sale,
                                    'car_gallery' => $car->gallery->map(fn($image) => url('img/' . $image->img))->toJson(),
                                    'car_gallery_name' => $car->gallery->map(fn($image) => $image->img)->toJson(),                                
                                ])
                                <button class="btn btn-danger delete-car" data-car-id="{{ $car->id }}">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.components.modals.add.car_add')
    @include('admin.components.modals.edit.car_edit')
    @include('admin.components.sweet_alert')
@endsection

@push('style')
@endpush

@push('js')
    <script>
        const deleteRoute = "{{ route('delete_car') }}"; 
    </script>
    <script src="{{ asset('js/views/car.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
@endpush