<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;

Route::get('/', function () {
    return view(('user.home'));
});

Route::get('/dataSheet', function () {
    return view('user.data-sheet');
});