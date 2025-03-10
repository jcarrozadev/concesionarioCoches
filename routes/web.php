<?php

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\ColorsController;
use App\Http\Controllers\TypesController;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Response;

Route::get('/', [CarsController::class, 'getCars'])->name('home');

Route::get('/admin', [CarsController::class, 'getCarsAdmin'])->name('admin');

Route::get('/admin/brands', function ():View {
    return BrandsController::getBrands();
})->name('brands');

Route::get('/admin/types', function ():View {
    return TypesController::getTypes();
})->name('types');

Route::get('/admin/colors', function ():View {
    return ColorsController::getColors();
})->name('colors');


// Routes Add

Route::post('/admin/addCar', [CarController::class, 'addCar'])->name('addCar');
Route::post('/admin/addColor', [ColorsController::class, 'addColor'])->name('addColor');
Route::post('/admin/addBrand', [BrandsController::class, 'addBrand'])->name('addBrand');
Route::post('/admin/addType', [TypesController::class, 'addType'])->name('addType');

// Routes Delete

Route::post('/admin/delete_car', [CarController::class, 'removeCar'])->name('delete_car');
Route::post('/admin/delete_color', [ColorsController::class, 'removeColor'])->name('delete_color');
Route::post('/admin/delete_brand', [BrandsController::class, 'removeBrand'])->name('delete_brand');
Route::post('/admin/sub_delete_brand', [CarsController::class, 'getCarsWithBrand'])->name('sub_delete_brand');
Route::post('/admin/delete_type', [TypesController::class, 'removeType'])->name('delete_type');
Route::post('/admin/sub_delete_type', [CarsController::class, 'getCarsWithType'])->name('sub_delete_type');

// Routes Edit

Route::put('/admin/edit_brand', [BrandsController::class, 'editBrand'])->name('editBrand');
Route::put('/admin/edit_color', [ColorsController::class, 'editColor'])->name('editColor');
Route::put('/admin/updateType', [TypesController::class, 'updateType'])->name('updateType');
Route::put('/admin/updateCar', [CarController::class, 'updateCar'])->name('updateCar');

// Other routes

Route::get('/datasheet/{id}', [CarController::class, 'getCar'])->name('datasheet');


Route::get('/img/{filename}', function ($filename) {
    $path = storage_path('app/public/img/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    $file = file_get_contents($path);
    $type = mime_content_type($path);

    return Response::make($file, 200)->header('Content-Type', $type);
});