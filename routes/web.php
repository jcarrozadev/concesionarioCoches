<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dataSheet', function () {
    return view('user.data-sheet');
});
