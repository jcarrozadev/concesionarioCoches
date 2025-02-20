<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use App\Models\Brands;
use App\Models\Colors;
use App\Models\Types;
use App\Models\Gallery;
use Illuminate\Contracts\View\View;

class CarsController extends Controller
{
    public static function getCars(): View {

        $cars = Cars::getCarsAll();
        $carsOffers = Cars::getCarsOffers();
        $carsNotOffers = Cars::getCarsNotOffers();
        $brands = Brands::getBrandsAll();
        $colors = Colors::getColorsAll();

        return view('user.home', ['cars' => $cars, 'carsOffers' => $carsOffers, 'carsNotOffers' => $carsNotOffers, 'brands' => $brands, 'colors' => $colors]);
    }

    public static function getCar($id): View {

        $car = Cars::getCar($id);
        $images = Gallery::getImages($id);
        return view('user.data_sheet')->with(['car' => $car])->with('images', $images);
    }

    public static function getCarsAdmin() {
        $cars = Cars::getCarsAll();

        return view('admin.cars', ['cars' => $cars]);
    }
  
    public static function getColors(): View {
        return view('admin.colors', ['colors' => Colors::getColorsAll()]);
      }
    
    public static function getTypes(): View {
      return view('admin.types', ['types' => Types::getTypesAll()]);
    }
    
    public static function getBrands() {
      return view('admin.brands', ['brands' => Brands::getBrands()]);
    }

}
