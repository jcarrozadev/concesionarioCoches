<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;

class CarsController extends Controller
{
    public static function getCars() {

        $cars = Cars::getCarsAll();
        $carsOffers = Cars::getCarsOffers();
        $carsNotOffers = Cars::getCarsNotOffers();

        return view('user.home', ['cars' => $cars, 'carsOffers' => $carsOffers, 'carsNotOffers' => $carsNotOffers]);
    }
}
