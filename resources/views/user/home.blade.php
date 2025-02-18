@extends('user.layout')

@section('title')
    Home
@endsection

@section('content')
    @include('user.components.filter')
    <section id="carsOffers" name="carsOffers">
        <div class="text-center fs-3 title-section">
            <strong>SALE</strong>
        </div>
        <div class="container my-5">
            <div class="row">
                <div class="col-md-3" v-for="i in 4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="img-placeholder" style="background: #ddd; height: 150px;">IMG</div>
                            <h5 class="card-title mt-2 fs-4">Seat Arona</h5>
                            <div class="row">
                                <div class="col-6">
                                    <p class="card-text">Color: Red</p>
                                    <p class="card-text">Año: 2021</p>
                                </div>
                                <div class="col-6">
                                    <p class="card-text">Marca: Seat</p>
                                    <p class="card-text">CV: 150</p>
                                </div>
                            </div>
                            <p class="fw-bold fs-5 mt-2">16.100€</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" v-for="i in 4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="img-placeholder" style="background: #ddd; height: 150px;">IMG</div>
                            <h5 class="card-title mt-2 fs-4">Seat Arona</h5>
                            <div class="row">
                                <div class="col-6">
                                    <p class="card-text">Color: Red</p>
                                    <p class="card-text">Año: 2021</p>
                                </div>
                                <div class="col-6">
                                    <p class="card-text">Marca: Seat</p>
                                    <p class="card-text">CV: 150</p>
                                </div>
                            </div>
                            <p class="fw-bold fs-5 mt-2">16.100€</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" v-for="i in 4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="img-placeholder" style="background: #ddd; height: 150px;">IMG</div>
                            <h5 class="card-title mt-2 fs-4">Seat Arona</h5>
                            <div class="row">
                                <div class="col-6">
                                    <p class="card-text">Color: Red</p>
                                    <p class="card-text">Año: 2021</p>
                                </div>
                                <div class="col-6">
                                    <p class="card-text">Marca: Seat</p>
                                    <p class="card-text">CV: 150</p>
                                </div>
                            </div>
                            <p class="fw-bold fs-5 mt-2">16.100€</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" v-for="i in 4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="img-placeholder" style="background: #ddd; height: 150px;">IMG</div>
                            <h5 class="card-title mt-2 fs-4">Seat Arona</h5>
                            <div class="row">
                                <div class="col-6">
                                    <p class="card-text">Color: Red</p>
                                    <p class="card-text">Año: 2021</p>
                                </div>
                                <div class="col-6">
                                    <p class="card-text">Marca: Seat</p>
                                    <p class="card-text">CV: 150</p>
                                </div>
                            </div>
                            <p class="fw-bold fs-5 mt-2">16.100€</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="carsAll" name="carsAll">
        <div class="text-center fs-3 title-section">
            <strong>All Vehicles</strong>
        </div>
        <div class="container my-5">
            <div class="row">
                <div class="col-md-3" v-for="i in 4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="img-placeholder" style="background: #ddd; height: 150px;">IMG</div>
                            <h5 class="card-title mt-2 fs-4">Seat Arona</h5>
                            <div class="row">
                                <div class="col-6">
                                    <p class="card-text">Color: Red</p>
                                    <p class="card-text">Año: 2021</p>
                                </div>
                                <div class="col-6">
                                    <p class="card-text">Marca: Seat</p>
                                    <p class="card-text">CV: 150</p>
                                </div>
                            </div>
                            <p class="fw-bold fs-5 mt-2">16.100€</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('carsOffers')


@endsection

@push('style')
@endpush

@push('js')
    <script src="{{ asset('js/user.js') }}"></script>
@endpush