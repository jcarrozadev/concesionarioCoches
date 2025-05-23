@extends('user.layout')

@section('title')
    AllStarsAutos | Inicio
@endsection

@section('content')
    <div class="w-100 mx-auto mobilefilter">
        <button class="btn btn-changes d-lg-none w-100 text-center mt-0" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
            Mostrar Filtro
        </button>
        <div class="collapse d-lg-block" id="filterCollapse">
            @include('user.components.filter')
        </div>
    </div>
    <section id="carsOffers" name="carsOffers">
        <div class="text-center title-section">
            <strong>Ofertas</strong>
        </div>
    
        <div class="container my-5">
            <div class="row g-3">
                @if ($carsOffers->isEmpty())
                    <p class="text-center w-100">No hay coches en oferta disponibles en este momento.</p>
                @else
                    @foreach ($carsOffers as $car)
                        <div class="col-sm-12 col-md-4 col-lg-3 car-offer" data-car-id="{{ $car->id }}" data-car-name="{{ $car->name }}" data-car-brand="{{ $car->brand->id }}" data-car-color="{{ $car->color->id }}" data-car-year="{{ $car->year }}" data-car-horsepower="{{ $car->horsepower }}" data-car-price="{{ $car->price }}">
                            <div class="card card-offer" data-car-id="{{ $car->id }}" >
                                <span class="discount-tag">Oferta</span>
                                <img src="{{ url('img/' . $car->main_img) }}" alt="{{ $car->brand->name . $car->name }}" class="card-img-top" style="height: 150px; width: 100%; object-fit: cover;">
                                <div class="card-body">
                                    <h7 class="card-title">DESDE</h7>
                                    <p class="card-text">
                                        <span style="font-size: 1.5rem; font-weight: bold;">{{ $car->price }} €</span> 
                                    </p>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $car->brand->name . ' ' . $car->name }}</h6>
                                    <div class="row align-items-center align-middle">
                                        <div class="col-12">
                                            <p class="card-text">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-palette align-middle"></i>
                                                    <input type="color" class="w-10 ms-2" style="border: none;" name="" id="" value="{{ $car->color->hex }}" disabled>
                                                </div>
                                            </p>
                                            <p class="card-text">
                                                <i class="fas fa-tachometer-alt"></i>
                                                {{ $car->horsepower }} cv
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <section id="carsAll" name="carsAll">
        <div class="text-center fs-3 title-section">
            <strong>Vehículos</strong>
        </div>
        <div class="container my-5">
            <div class="row g-3">
                @if ($cars->isEmpty())
                    <p class="text-center w-100">No hay vehículos disponibles en este momento.</p>
                @else
                    @foreach ($cars as $car)
                        <div class="col-sm-12 col-md-4 col-lg-3 card-all" data-car-id="{{ $car->id }}" data-car-name="{{ $car->name }}" data-car-brand="{{ $car->brand->id }}" data-car-color="{{ $car->color->id }}" data-car-year="{{ $car->year }}" data-car-horsepower="{{ $car->horsepower }}" data-car-price="{{ $car->price }}">
                            <div class="card" data-car-id="{{ $car->id }}">
                                <img src="{{ url('img/' . $car->main_img) }}" alt="{{ $car->brand->name . $car->name }}" class="card-img-top" style="height: 150px; width: 100%; object-fit: cover;">
                                <div class="card-body">
                                    <h6 class="card-title">DESDE</h6>
                                    <p class="card-text">
                                        <span style="font-size: 1.5rem; font-weight: bold;">{{ $car->price }} €</span> 
                                    </p>
                                    <h5 class="card-subtitle mb-2 text-muted">{{ $car->brand->name . ' ' . $car->name }}</h5>
                                    <div class="row align-items-center align-middle">
                                        <div class="col-12">
                                            <p class="card-text">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-palette align-middle"></i>
                                                    <input type="color" class="w-10 ms-2" style="border: none;" name="" id="" value="{{ $car->color->hex }}" disabled>
                                                </div>
                                            </p>
                                            <p class="card-text">
                                                <i class="fas fa-tachometer-alt"></i>
                                                {{ $car->horsepower }} cv
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>    
@endsection

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/views/home.css') }}">
@endpush

@push('js')
    {{-- <script src="{{ asset('js/user.js') }}"></script> --}}
    <script type="module" src="{{ asset('js/views/home.js') }}"></script>
@endpush