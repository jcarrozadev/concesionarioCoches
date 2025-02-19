@extends('admin.layout')

@section('title')
    Admin Panel | Vehículos
@endsection

@section('content')
    <div class="containerTable">
        @include('admin.components.button_add')
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
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>C3</td>
                        <td>Citroen</td>
                        <td>SUV</td>
                        <td>Grey</td>
                        <td>2021</td>
                        <td>110CV</td>
                        <td>Yes</td>
                        <td id="buttonFields">
                            <button class="btn btn-secondary">Editar</button>
                            <button class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
        
@endsection

@push('style')
@endpush

@push('js')
    <script src="{{ asset('js/admin.js') }}"></script>
@endpush