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

Route::post('/admin/addBrand', [CarsController::class, 'addBrand'])->name('addBrand');

Route::post('/admin/delete_car', [CarsController::class, 'removeCar'])->name('delete_car');

Route::post('/admin/delete_brand', [CarsController::class, 'removeBrand'])->name('delete_brand');

Route::post('/admin/sub_delete_brand', [CarsController::class, 'getCarsWithBrand'])->name('sub_delete_brand');

Route::get('/datasheet/{id}', function ($id) {
    return CarsController::getCar($id);
})->name('datasheet');


