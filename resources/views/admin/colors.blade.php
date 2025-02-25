@extends('admin.layout')

@section('title')
    Admin Panel | Colores
@endsection

@section('content')
    <div class="containerTable">
        @include('admin.components.modals.add.color_add')
        @include('admin.components.button_add', ['action' => 'addColor'])
        <div class="table-wrapper">
            <table id="table" class="display text-center datatable">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Color</th>
                        <th class="text-center">Hexadecimal</th>
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
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($colors as $color)
                        <tr>
                            <td>{{ $color->id }}</td>
                            <td>{{ $color->name }}</td>
                            <td>{{ $color->hex }}</td>
                            <td id="buttonFields">
                                @include('admin.components.button_edit', ['action' => 'editColor', 'id' => $color->id, 'name' => $color->name, 'hex' => $color->hex])
                                <button class="btn btn-danger delete-color" data-color-id="{{ $color->id }}">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.components.modals.edit.color_edit')
    @include('admin.components.sweet_alert')
        
@endsection

@push('style')
@endpush

@push('js')
    <script>
        const deleteRoute = "{{ route('delete_color') }}"; 
    </script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/views/color.js') }}"></script>
@endpush