<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use App\Models\Brands;
use App\Models\Colors;
use App\Models\Types;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Gallery;

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

    public static function getCarsAdmin(): View {
        $cars = Cars::getCarsAll();
        $brands = Brands::getBrandsAll();
        $colors = Colors::getColorsAll();
        $types = Types::getTypesAll();

        return view('admin.cars', ['cars' => $cars, 'brands' => $brands, 'colors' => $colors, 'types' => $types]);
    }

    public static function addCar(Request $request): RedirectResponse {

        $data = $request->all();

        $data = $request->validate([
            'name' => 'required|string',
            'brand_id' => 'required|integer',
            'type_id' => 'required|integer',
            'color_id' => 'required|integer',
            'year' => 'required|integer',
            'main_img' => 'required|file',
            'horsepower' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        if(!isset($data['sale'])) {
            $data['sale'] = 0;
        }

        $timestamp = now()->format('Y-m-d_H-i-s') . '_' . round(microtime(true) * 1000);
        $data['main_img'] = $timestamp . '_' . $data['main_img']->getClientOriginalName();

        $request->file('main_img')->storeAs('img', $data['main_img'], 'public');

        return Cars::addCar($data) 
                    ? redirect()->route('admin')->with('success', 'Vehículo añadido correctamente') 
                    : redirect()->route('admin')->with('error', 'Error al añadir el vehículo');

    }

    public static function removeCar(Request $request): mixed {
        return Cars::removeCar($request->car_id) 
                    ? response()->json(['success' => 'Coche eliminado correctamente.'])
                    : response()->json(['error' => 'Error al eliminar el coche.'], 500);
    }

    public static function removeColor(Request $request): mixed {
        return Colors::removeColor($request->color_id) 
                    ? response()->json(['success' => 'Color eliminado correctamente.'])
                    : response()->json(['error' => 'Error al eliminar el color.'], 500);
    }
        
    public static function getColors(): View {
      return view('admin.colors', ['colors' => Colors::getColorsAll()]);
    }  
  
    public static function getTypes(): View {
      return view('admin.types', ['types' => Types::getTypesAll()]);
    }
    
    public static function getBrands(): View {
      return view('admin.brands', ['brands' => Brands::getBrandsAll()]);
    }

}
