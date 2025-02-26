@extends('user.layout')

@section('title')
    Home
@endsection

@section('content')
    @include('user.components.filter')
    <section id="carsOffers" name="carsOffers">
        <div class="text-center fs-3 title-section">
            <strong>Ofertas</strong>
        </div>
        <div class="container my-5">
            <div class="row g-3">
                @foreach ($carsOffers as $car)
                    <div class="col-md-3 car-offer" data-car-id="{{ $car->id }}" data-car-name="{{ $car->name }}" data-car-brand="{{ $car->brand_id }}" data-car-color="{{ $car->color_id }}" data-car-year="{{ $car->year }}" data-car-horsepower="{{ $car->horsepower }}" data-car-price="{{ $car->price }}">
                        <div class="card card-offer" data-car-id="{{ $car->id }}">
                            <div class="card-body text-center">
                                <img src="{{ url('img/' . $car->main_img) }}" alt="{{ $car->brand_name . $car->name }}" style="height: 150px; width: 100%; object-fit: cover;">
                                <h5 class="card-title mt-2 fs-4">{{ $car->name }}</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="card-text">Color: {{ $car->color_name }}</p>
                                        <p class="card-text">Año: {{ $car->year }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="card-text">Marca: {{ $car->brand_name }}</p>
                                        <p class="card-text">CV: {{ $car->horsepower }}</p>
                                    </div>
                                </div>
                                <p class="fw-bold fs-5 mt-2">Precio: {{ $car->price }}€</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="carsAll" name="carsAll">
        <div class="text-center fs-3 title-section">
            <strong>Vehículos</strong>
        </div>
        <div class="container my-5">
            <div class="row g-3">
                @foreach ($cars as $car)
                    <div class="col-md-3 card-all" data-car-id="{{ $car->id }}" data-car-name="{{ $car->name }}" data-car-brand="{{ $car->brand_id }}" data-car-color="{{ $car->color_id }}" data-car-year="{{ $car->year }}" data-car-horsepower="{{ $car->horsepower }}" data-car-price="{{ $car->price }}">
                        <div class="card" data-car-id="{{ $car->id }}">
                            <div class="card-body text-center">
                                <img src="{{ asset('img/' . $car->main_img) }}" alt="{{ $car->brand_name . $car->name }}" style="height: 150px; width: 100%; object-fit: cover;">
                                <h5 class="card-title mt-2 fs-4">{{ $car->name }}</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="card-text">Color: {{ $car->color_name }}</p>
                                        <p class="card-text">Año: {{ $car->year }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="card-text">Marca: {{ $car->brand_name }}</p>
                                        <p class="card-text">CV: {{ $car->horsepower }}</p>
                                    </div>
                                </div>
                                <p class="fw-bold fs-5 mt-2">Precio: {{ $car->price }}€</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('style')
@endpush

@push('js')
    <script src="{{ asset('js/user.js') }}"></script>
    <script src="{{ asset('js/views/home.js') }}"></script>
@endpush