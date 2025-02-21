<?php

use App\Http\Controllers\BrandsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\ColorsController;
use App\Http\Controllers\TypesController;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return CarsController::getCars();
})->name('home');

Route::get('/admin', function () {
    return CarsController::getCarsAdmin();
})->name('admin');

Route::get('/admin/brands', function () {
    return BrandsController::getBrands();
})->name('brands');

Route::get('/admin/types', function () {
    return TypesController::getTypes();
})->name('types');

Route::get('/admin/colors', function () {
    return ColorsController::getColors();
})->name('colors');

Route::get('/testModals', function () {
    return view('admin.test_modals');
});

// Routes Add

Route::post('/admin/addCar', [CarsController::class, 'addCar'])->name('addCar');
Route::post('/admin/addColor', [ColorsController::class, 'addColor'])->name('addColor');
Route::post('/admin/addBrand', [BrandsController::class, 'addBrand'])->name('addBrand');

// Routes Delete

Route::post('/admin/delete_car', [CarsController::class, 'removeCar'])->name('delete_car');
Route::post('/admin/delete_color', [ColorsController::class, 'removeColor'])->name('delete_color');
Route::post('/admin/delete_brand', [BrandsController::class, 'removeBrand'])->name('delete_brand');
Route::post('/admin/sub_delete_brand', [CarsController::class, 'getCarsWithBrand'])->name('sub_delete_brand');
Route::post('/admin/delete_type', [TypesController::class, 'removeType'])->name('delete_type');
Route::post('/admin/sub_delete_type', [CarsController::class, 'getCarsWithType'])->name('sub_delete_type');

// Other routes

Route::get('/datasheet/{id}', function ($id) {
    return CarsController::getCar($id);
})->name('datasheet');


Route::get('/img/{filename}', function ($filename) {
    $path = storage_path('app/public/img/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    $file = file_get_contents($path);
    $type = mime_content_type($path);

    return Response::make($file, 200)->header('Content-Type', $type);
});