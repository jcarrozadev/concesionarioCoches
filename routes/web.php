<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\TypeController;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Response;

Route::get('/', function ():View {
    
    $car = new CarsController(1);
    $carOffers = new CarsController(2);
    $brand = new BrandController();
    $brands = $brand->getBrands();
    $color = new ColorController();
    $colors = $color->getColors();


    $cars = $car->setCars();
    $carsOffers = $carOffers->setCars();

    return view('user.home')
    ->with('cars', $cars)
    ->with('carsOffers', $carsOffers)
    ->with('brands', $brands)
    ->with('colors', $colors);


})->name('home');

Route::get('/admin', function ():View {

    $car = new CarsController(1);
    $cars = $car->setCars();

    $brand = new BrandController();
    $brands = $brand->getBrands();
    $color = new ColorController();
    $colors = $color->getColors();
    $type = new TypeController();
    $types = $type->getTypes();

    return view('admin.cars')
    ->with('cars', $cars)
    ->with('brands', $brands)
    ->with('colors', $colors)
    ->with('types', $types);
    
})->name('admin');

Route::get('/admin/brands', function ():View {
    
    $brand = new BrandController();
    $brands = $brand->getBrands();

    return view('admin.brands', ['brands' => $brands]);

})->name('brands');

Route::get('/admin/types', function ():View {
    
    $type = new TypeController();
    $types = $type->getTypes();

    return view('admin.types', ['types' => $types]);

})->name('types');

Route::get('/admin/colors', function ():View {
    
    $color = new ColorController();
    $colors = $color->getColors();

    return view('admin.colors', ['colors' => $colors]);

})->name('colors');


// Routes Add

Route::post('/admin/addCar', [CarController::class, 'addCar'])->name('addCar');
Route::post('/admin/addColor', [ColorController::class, 'addColor'])->name('addColor');
Route::post('/admin/addBrand', [BrandController::class, 'addBrand'])->name('addBrand');
Route::post('/admin/addType', [TypeController::class, 'addType'])->name('addType');

// Routes Delete

Route::post('/admin/delete_car', [CarController::class, 'removeCar'])->name('delete_car');
Route::post('/admin/delete_color', [ColorController::class, 'removeColor'])->name('delete_color');
Route::post('/admin/delete_brand', [BrandController::class, 'removeBrand'])->name('delete_brand');
Route::post('/admin/sub_delete_brand', [CarsController::class, 'getCarsWithBrand'])->name('sub_delete_brand');
Route::post('/admin/delete_type', [TypeController::class, 'removeType'])->name('delete_type');
Route::post('/admin/sub_delete_type', [CarsController::class, 'getCarsWithType'])->name('sub_delete_type');

// Routes Edit

Route::put('/admin/edit_brand', [BrandController::class, 'editBrand'])->name('editBrand');
Route::put('/admin/edit_color', [ColorController::class, 'editColor'])->name('editColor');
Route::put('/admin/updateType', [TypeController::class, 'updateType'])->name('updateType');
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