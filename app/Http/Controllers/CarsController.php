<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use App\Models\Brands;
use App\Models\Colors;
use App\Models\Types;

class CarsController extends Controller
{
    public static function getCars() {

        $cars = Cars::getCarsAll();
        $carsOffers = Cars::getCarsOffers();
        $carsNotOffers = Cars::getCarsNotOffers();
        $brands = Brands::getBrandsAll();
        $colors = Colors::getColorsAll();

        return view('user.home', ['cars' => $cars, 'carsOffers' => $carsOffers, 'carsNotOffers' => $carsNotOffers, 'brands' => $brands, 'colors' => $colors]);
    }

    public static function getCarsAdmin() {
        $cars = Cars::getCarsAll();

        return view('admin.cars', ['cars' => $cars]);
    }
  
    public static function getColors() {
        return view('admin.colors', ['colors' => Colors::getColorsAll()]);
      }
    
      public static function getTypes() {
        return view('admin.types', ['types' => Types::getTypesAll()]);
      }
}
