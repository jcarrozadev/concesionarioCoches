@extends('admin.layout')

@section('title')
    Admin Panel | Marcas
@endsection

@section('content')
    <div class="containerTable">
        @include('admin.components.button_add')
        <div class="table-wrapper">
            <table id="table" class="display text-center datatable">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Marca</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    <tr>
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
                    @foreach ($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>{{ $brand->name }}</td>
                            <td id="buttonFields">
                                <button class="btn btn-secondary">Editar</button>
                                <button class="btn btn-danger">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
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