@extends('admin.layout')

@section('title')
    AllStarsAutos | Panel Marcas
@endsection

@section('content')
    <div class="containerTable">
        <div class="title">
            <h3>Marcas</h3>
        </div>
        @include('admin.components.modals.add.brand_add')
        @include('admin.components.button_add', ['action' => 'addBrand'])
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
                                @include('admin.components.button_edit', ['action' => 'editBrand', 'id' => $brand->id], ['name' => $brand->name])
                                <button class="btn btn-danger delete-btn" data-brand-id="{{ $brand->id }}" data-brand-name="{{ $brand->name }}">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('admin.components.modals.edit.brand_edit')
    @include('admin.components.sweet_alert')

@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/views/brands.css') }}">
@endpush

@push('js')
    <script>
        const takeCars = "{{ route('sub_delete_brand') }}"; 
        const deleteRoute = "{{ route('delete_brand') }}"; 
    </script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script type="module" src="{{ asset('js/views/brands.js') }}"></script>
@endpush