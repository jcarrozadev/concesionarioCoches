@extends('user.layout')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/data_sheet.css') }}">
@endpush

@section('title')
    Ficha técnica
@endsection

@section('content')
    <div id="carouselExampleControlsNoTouching" class="carousel slide w-75 mx-auto my-1" data-bs-touch="false">
        <div class="carousel-inner">
            <div class="carousel-item active">
                {{-- <img src="{{ url('/images/example.jpg') }}" alt="Example Image"> --}}
                <img src="{{ url('/img/'.$car->main_img) }}" class="d-block w-100" alt="..." style="height: 400px; object-fit: cover; object-position: center;">            
            </div>
            @foreach ($images as $image) 
                <div class="carousel-item">
                    <img src="{{ asset('img/'.$image->img) }}" class="d-block w-100" alt="..." style="height: 400px; object-fit: cover; object-position: center;">
                </div>
            @endforeach
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
        <h2 class="fs-4">{{ $car->brand_name.' '.$car->name }}</h2>
        <div class="d-flex flex-row align-items-center justify-content-between text-center">
            <div>
                <p class="fw-bold">Tipo</p>
                <p>{{ $car->type_name }}</p>
            </div>
            <div>
                <p class="fw-bold">Año</p>
                <p>{{ $car->year }}</p>
            </div>
            <div>
                <p class="fw-bold">CV</p>
                <p>{{ $car->horsepower }}</p>
            </div>
        </div>
        <div class="d-flex flex-row align-items-center justify-content-between text-center">
            <div>
                <p class="fw-bold">Color</p>
                <p><input type="color" class="w-100" name="" id="" value="{{ $car->hex }}" disabled></p>
                {{-- <p>{{ $car->color_name }}</p> --}}
            </div>
            <div>
                <p class="fw-bold">Precio</p>
                <p>{{ $car->price }}€</p>
            </div>
        </div>
    </div>
@endsection