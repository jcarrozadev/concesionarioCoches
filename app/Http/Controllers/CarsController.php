<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;
use App\Models\Cars;
use App\Models\Colors;
use App\Models\Types;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class CarsController extends Controller
{
    // private bool $sale = false;

    public function __construct() {}

    /**
     * Summary of getCars
     * @return View
     */
    public function getCars(): View {

        $brands = Brands::getBrandsAll();
        $colors = Colors::getColorsAll();

        $carsController = $this->setCarsAll();
        $carsSaleController = $this->setCarsSale();
        
        return view('user.home', ['cars' => $carsController, 'carsOffers' => $carsSaleController, 'brands' => $brands, 'colors' => $colors]);
    }

    /**
     * Summary of getCarsAdmin
     * @return View
     */
    public function getCarsAdmin(): View {
        $cars = $this->setCarsAll();
        $brands = Brands::getBrandsAll();
        $colors = Colors::getColorsAll();
        $types = Types::getTypesAll();

        return view('admin.cars', ['cars' => $cars, 'brands' => $brands, 'colors' => $colors, 'types' => $types]);
    }

    /**
     * Summary of setCarsAll
     * @return \Illuminate\Database\Eloquent\Collection<int, array>|\Illuminate\Support\Collection<int, array>
     */
    private function setCarsAll(): Collection{
        return Cars::getCarsAll()->map(function ($car): CarController {
            $carController = new CarController();
            
            $carController->setId($car->id);
            $carController->setBrandId($car->brand_id);
            $carController->setBrandName($car->brand_name);
            $carController->setTypeId($car->type_id);
            $carController->setTypeName($car->type_name);
            $carController->setColorId($car->color_id);
            $carController->setColorName($car->color_name);
            $carController->setHex($car->color_hex);
            $carController->setName($car->name);
            $carController->setYear($car->year);
            $carController->setHorsepower($car->horsepower);
            $carController->setPrice($car->price);
            $carController->setMainImg($car->main_img);
            $carController->setSale($car->sale);
            $carController->setGallery($car->gallery);
            

    
            return $carController;
        });
    }

    /**
     * Summary of setCarsSale
     * @return \Illuminate\Database\Eloquent\Collection<int, CarController>|\Illuminate\Support\Collection<int, CarController>
     */
    private function setCarsSale(): Collection {
        return Cars::getCarsOffers()->map(function ($car): CarController {
            $carSaleController = new CarController();
            
            $carSaleController->setId($car->id);
            $carSaleController->setBrandId($car->brand_id);
            $carSaleController->setTypeId($car->type_id);
            $carSaleController->setColorId($car->color_id);
            $carSaleController->setBrandName($car->brand_name);
            $carSaleController->setTypeName($car->type_name);
            $carSaleController->setColorName($car->color_name);
            $carSaleController->setHex($car->color_hex);
            $carSaleController->setName($car->name);
            $carSaleController->setYear($car->year);
            $carSaleController->setHorsepower($car->horsepower);
            $carSaleController->setPrice($car->price);
            $carSaleController->setMainImg($car->main_img);
            $carSaleController->setSale($car->sale);
            
    
            return $carSaleController;
        });
    }

    /**
     * Summary of getCarsWithType
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getCarsWithType(Request $request): mixed {
        $carsDeleted = Cars::getCarsWithType($request->type_id);
        return ($carsDeleted)
            ? response()->json([
                'success' => 'Info obtenida.',
                'carsDeleted' => $carsDeleted
            ])
            : response()->json(['error' => 'Error al eliminar los coches o la marca.'], 500);
    }

    /**
     * Summary of getCarsWithBrand
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getCarsWithBrand(Request $request): mixed {
        $carsDeleted = Cars::getCarsWithBrand($request->brand_id);
        return ($carsDeleted)
            ? response()->json([
                'success' => 'Info obtenida',
                'carsDeleted' => $carsDeleted
            ])
            : response()->json(['error' => 'Sin datos.'], 500);
    }
}
