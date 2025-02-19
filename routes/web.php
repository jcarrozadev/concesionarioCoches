<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;

Route::get('/', function () {
    return CarsController::getCars();
});

Route::get('/dataSheet', function () {
    return view('user.data-sheet');
});