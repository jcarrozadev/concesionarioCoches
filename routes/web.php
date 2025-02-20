<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;

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
    return CarsController::getTypes();
})->name('types');

Route::get('/admin/colors', function () {
    return CarsController::getColors();
})->name('colors');

Route::get('/testModals', function () {
    return view('admin.test_modals');
});

Route::post('/admin/addCar', [CarsController::class, 'addCar'])->name('addCar');
Route::post('/admin/addColor', [CarsController::class, 'addColor'])->name('addColor');

Route::post('/admin/delete_car', [CarsController::class, 'removeCar'])->name('delete_car');
Route::post('/admin/delete_color', [CarsController::class, 'removeColor'])->name('delete_color');

Route::get('/datasheet/{id}', function ($id) {
    return CarsController::getCar($id);
})->name('datasheet');

