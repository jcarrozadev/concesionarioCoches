@extends('admin.layout')

@section('title')
    Admin Panel | Tipos
@endsection

@section('content')
    <div class="containerTable">
        @include('admin.components.button_add', ['action' => 'addType'])
        <div class="table-wrapper">
            <table id="table" class="display text-center datatable">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Tipo</th>
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
                    @foreach ($types as $type)
                        <tr>
                            <td>{{ $type->id }}</td>
                            <td>{{ $type->name }}</td>
                            <td id="buttonFields">
                                <button class="btn btn-secondary">Editar</button>
                                <button class="btn btn-danger" data-type-id="{{ $type->id }}" data-type-name="{{ $type->name }}>Eliminar</button>
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