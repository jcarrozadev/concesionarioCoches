<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use Illuminate\Support\Collection;

class CarsController extends Controller
{
    private string $type;

    public function __construct(string $type = 'all') {
        $this->type = $type;
    }

    public function setCars() {
        if ($this->type === 'all') {
            return $this->setCarsAll();
        } elseif ($this->type === 'sale') {
            return $this->setCarsSale();
        }
    }

    /**
     * Summary of setCarsAll
     * @return \Illuminate\Database\Eloquent\Collection<int, array>|\Illuminate\Support\Collection<int, array>
     */
    private function setCarsAll(): Collection{
        return Cars::getCarsAll()->map(function ($car): CarController {
            $carController = new CarController();
            
            $carController->setId($car->id);
            $carController->brand->setId($car->brand_id);
            $carController->brand->setName($car->brand_name);
            $carController->type->setId($car->type_id);
            $carController->type->setName($car->type_name);
            $carController->color->setId($car->color_id);
            $carController->color->setName($car->color_name);
            $carController->color->setHex($car->color_hex);
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
            $carSaleController->brand->setId($car->brand_id);
            $carSaleController->brand->setName($car->brand_name);
            $carSaleController->type->setId($car->type_id);
            $carSaleController->type->setName($car->type_name);
            $carSaleController->color->setId($car->color_id);
            $carSaleController->color->setName($car->color_name);
            $carSaleController->color->setHex($car->color_hex);
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
