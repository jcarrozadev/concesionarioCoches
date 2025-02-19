<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use App\Models\Brands;
use App\Models\Colors;
use App\Models\Types;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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

    public static function getCarsAdmin(): View {
        $cars = Cars::getCarsAll();
        $brands = Brands::getBrandsAll();
        $colors = Colors::getColorsAll();
        $types = Types::getTypesAll();

        return view('admin.cars', ['cars' => $cars, 'brands' => $brands, 'colors' => $colors, 'types' => $types]);
    }
  
    public static function getColors(): View {
      return view('admin.colors', ['colors' => Colors::getColorsAll()]);
    }

    public static function addCar(Request $request): RedirectResponse {

        $data = $request->all();

        // $data = $request->validate([
        //     'name' => 'required|string',
        //     'brand_id' => 'required|integer',
        //     'type_id' => 'required|integer',
        //     'color_id' => 'required|integer',
        //     'year' => 'required|string',
        //     'main_img' => 'required|string',
        //     'horsepower' => 'required|numeric',
        //     'price' => 'required|numeric',
        //     'sale' => 'required|boolean',
        //     'enabled' => 'required|boolean'
        // ]);

        if(!isset($data['sale'])) {
            $data['sale'] = 0;
        }

        $timestamp = now()->format('Y-m-d_H-i-s') . '_' . round(microtime(true) * 1000);
        $data['main_img'] = $timestamp . '_' . $data['main_img']->getClientOriginalName();

        $request->file('main_img')->storeAs('img', $data['main_img'], 'public');

        return Cars::addCar($data) 
                    ? redirect()->route('admin')->with('success', 'Car added successfully') 
                    : redirect()->route('admin')->with('error', 'Error adding car');

    }
}
