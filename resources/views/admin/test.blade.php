@extends('admin.layout')
@section('content')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addType">
        TYPE
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBrand">
        BRAND
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addColor">
        COLOR
    </button>

    @include('admin.components.type-add')
    @include('admin.components.brand-add')
    @include('admin.components.color-add')
@endsection

