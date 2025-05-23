@extends('admin.layout')

@section('title')
    AllStarsAutos | Panel Tipos
@endsection

@section('content')
    <div class="containerTable">
        <div class="title">
            <h3>Tipos de Vehículos</h3>
        </div>
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
                                @include('admin.components.button_edit', ['action' => 'editType', 'id' => $type->id, 'name' => $type->name])
                                <button class="btn btn-danger delete-btn" data-type-id="{{ $type->id }}" data-type-name="{{ $type->name }}">Eliminar</button>                            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    @include('admin.components.modals.add.type_add')
    @include('admin.components.modals.edit.type_edit')
    @include('admin.components.sweet_alert')

@endsection

@push('style')
@endpush

@push('js')
    <script>
        const takeCars = "{{ route('sub_delete_type') }}"; 
        const deleteRoute = "{{ route('delete_type') }}"; 
    </script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script type="module" src="{{ asset('js/views/types.js') }}"></script>
@endpush