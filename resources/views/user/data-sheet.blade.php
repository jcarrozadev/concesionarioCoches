@extends('user.layout')
@push('style')
    <link rel="stylesheet" href="css/data-sheet.css">
@endpush

@section('title')
    Ficha técnica
@endsection

@section('content')
    <div id="carouselExampleControlsNoTouching" class="carousel slide w-75 mx-auto my-1" data-bs-touch="false">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/6kfondo.jpeg" class="d-block w-100" alt="..." style="height: 400px; object-fit: cover; object-position: center;">
            </div>
            <div class="carousel-item">
                <img src="img/6kfondo.jpeg" class="d-block w-100" alt="..." style="height: 400px; object-fit: cover; object-position: center;">
            </div>
            <div class="carousel-item">
                <img src="img/6kfondo.jpeg" class="d-block w-100" alt="..." style="height: 400px; object-fit: cover; object-position: center;">
            </div>
            <div class="carousel-item">
                <img src="img/6kfondo.jpeg" class="d-block w-100" alt="..." style="height: 400px; object-fit: cover; object-position: center;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="information-container w-75 mx-auto mt-1">
        <h2 class="fs-4">Marca y nombre del coche</h2>
        <div class="d-flex flex-row align-items-center justify-content-between text-center">
            <div>
                <p class="fw-bold">Tipo</p>
                <p>XXXX</p>
            </div>
            <div>
                <p class="fw-bold">Año</p>
                <p>XXXX</p>
            </div>
            <div>
                <p class="fw-bold">CV</p>
                <p>XXXX</p>
            </div>
        </div>
        <div class="d-flex flex-row align-items-center justify-content-between text-center">
            <div>
                <p class="fw-bold">Color</p>
                <p>XXXX</p>
            </div>
            <div>
                <p class="fw-bold">Precio</p>
                <p>120.000€</p>
            </div>
        </div>
    </div>
@endsection