<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;

Route::get('/', function () {
    return CarsController::getCars();
})->name('home');

Route::get('/dataSheet', function () {
    return view('user.data-sheet');
});

Route::get('/admin', function () {
    return view('admin.cars');
})->name('admin');

Route::get('/admin/brands', function () {
    return view('admin.brands');
})->name('brands');

Route::get('/admin/types', function () {
    return view('admin.types');
})->name('types');

Route::get('/admin/colors', function () {
    return view('admin.colors');
})->name('colors');