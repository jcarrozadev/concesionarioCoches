<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;

Route::get('/', function () {
    return CarsController::getCars();
});

Route::get('/testModals', function () {
    return view('admin.test_modals');
});

