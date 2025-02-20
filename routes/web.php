<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Models\Cars;

Route::get('/', function () {
    return CarsController::getCars();
})->name('home');

Route::get('/admin', function () {
    return CarsController::getCarsAdmin();
})->name('admin');

Route::get('/admin/brands', function () {
    return CarsController::getBrands();
})->name('brands');

Route::get('/admin/types', function () {
    return view('admin.types');
})->name('types');

Route::get('/admin/colors', function () {
    return CarsController::getColors();
})->name('colors');

Route::get('/testModals', function () {
    return view('admin.test_modals');
});

Route::get('/datasheet/{id}', function ($id) {
    return CarsController::getCar($id);
})->name('datasheet');

