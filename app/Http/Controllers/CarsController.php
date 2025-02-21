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
    /**
     * Summary of getCars
     * @return View
     */
    public static function getCars(): View {

        $cars = Cars::getCarsAll();
        $carsOffers = Cars::getCarsOffers();
        $carsNotOffers = Cars::getCarsNotOffers();
        $brands = Brands::getBrandsAll();
        $colors = Colors::getColorsAll();

        return view('user.home', ['cars' => $cars, 'carsOffers' => $carsOffers, 'carsNotOffers' => $carsNotOffers, 'brands' => $brands, 'colors' => $colors]);
    }

    /**
     * Summary of getCar
     * @param mixed $id
     * @return View
     */
    public static function getCar($id): View {

        $car = Cars::getCar($id);
        $images = Gallery::getImages($id);
        return view('user.data_sheet')->with(['car' => $car])->with('images', $images);
    }

    /**
     * Summary of getCarsAdmin
     * @return View
     */
    public static function getCarsAdmin(): View {
        $cars = Cars::getCarsAll();
        $brands = Brands::getBrandsAll();
        $colors = Colors::getColorsAll();
        $types = Types::getTypesAll();

        return view('admin.cars', ['cars' => $cars, 'brands' => $brands, 'colors' => $colors, 'types' => $types]);
    }

    /**
     * Summary of validateCar
     * @param mixed $request
     */
    public function validateCar($request) {
        return $request->validate([
            'name' => 'required|string',
            'brand_id' => 'required|integer',
            'type_id' => 'required|integer',
            'color_id' => 'required|integer',
            'year' => 'required|integer',
            'main_img' => 'required|file',
            'horsepower' => 'required|numeric',
            'price' => 'required|numeric'
        ]);
    }

    public function parseImg($img) {
        $timestamp = now()->format('Y-m-d_H-i-s') . '_' . round(microtime(true) * 1000);
        return $timestamp . '_' . $img->getClientOriginalName();
    }

    /**
     * Summary of addCar
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function addCar(Request $request): RedirectResponse {

        $data = $request->all();

        $this->validateCar($request);

        if(!isset($data['sale'])) {
            $data['sale'] = 0;
        }

        $data['main_img'] = $this->parseImg($request->file('main_img'));
        $request->file('main_img')->storeAs('img', $data['main_img'], 'public'); // Move the file to public/img  (storage/app/public/img)

        return Cars::addCar($data) 
                    ? redirect()->route('admin')->with('success', 'Vehículo añadido correctamente') 
                    : redirect()->route('admin')->with('error', 'Error al añadir el vehículo');

    }

    /**
     * Summary of removeCar
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public static function removeCar(Request $request): mixed {
        return Cars::removeCar($request->car_id) 
                    ? response()->json(['success' => 'Coche eliminado correctamente.'])
                    : response()->json(['error' => 'Error al eliminar el coche.'], 500);
    }
      
    /**
     * Summary of getCarsWithBrand
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public static function getCarsWithBrand(Request $request): mixed {
        $carsDeleted = Cars::getCarsWithBrand($request->brand_id);
        return ($carsDeleted)
            ? response()->json([
                'success' => 'Info obtenida',
                'carsDeleted' => $carsDeleted
            ])
            : response()->json(['error' => 'Sin datos.'], 500);
    }
    
    public static function getCarsWithType(Request $request): mixed {
        $carsDeleted = Cars::getCarsWithType($request->type_id);
        return ($carsDeleted)
            ? response()->json([
                'success' => 'Info obtenida.',
                'carsDeleted' => $carsDeleted
            ])
            : response()->json(['error' => 'Error al eliminar los coches o la marca.'], 500);
    }
    
        
}
