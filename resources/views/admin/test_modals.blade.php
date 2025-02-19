@extends('admin.layout')
@section('content')
    <h1>Add</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addType">
        TYPE
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBrand">
        BRAND
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addColor">
        COLOR
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCar">
        CAR
    </button>

    @include('admin.components.modals.add.type_add')
    @include('admin.components.modals.add.brand_add')
    @include('admin.components.modals.add.color_add')
    @include('admin.components.modals.add.car_add')

    <br><br><br>
    <h1>Edit</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editType">
        TYPE
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editBrand">
        BRAND
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editColor">
        COLOR
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCar">
        CAR
    </button>

    @include('admin.components.modals.edit.type_edit')
    @include('admin.components.modals.edit.brand_edit')
    @include('admin.components.modals.edit.color_edit')
    @include('admin.components.modals.edit.car_edit')
@endsection

