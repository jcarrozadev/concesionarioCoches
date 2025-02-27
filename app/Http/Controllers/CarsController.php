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
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
    private function validateCar($request) {
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
        $request->file('main_img')->storeAs('img', $data['main_img'], 'public');

        try {
            $carId = Cars::addCar($data);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $this->parseImg($image);
                    $image->storeAs('img', $imagePath, 'public');
                    Gallery::addImage($carId, $imagePath);
                }
            }
            return redirect()->route('admin')->with('success', 'Vehículo añadido correctamente');

        } catch (\Exception $e) {
            return redirect()->route('admin')->with('error', 'Error al añadir el vehículo: ' . $e->getMessage());
        }

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
    
    public static function updateCar(Request $request): RedirectResponse {
        $validatedData = self::validateUpdateCar($request);
        $car = Cars::getCar($validatedData['id']);
        if (!$car) {
            redirect()->back()->with('error' , 'No se encuentra el coche seleccionado.');
        }
        $changes = self::validateChanges($validatedData, $car);
        
        if (empty($changes)) {
            return redirect()->back()->with('error', 'No ha habido cambios.');
        }
        if (isset($changes['main_img'])) {
            $changes['main_img'] = self::parseImg($request->file('main_img'));
            $request->file('main_img')->storeAs('img', $changes['main_img'], 'public');
            Storage::disk('public')->delete('img/'.$car->main_img);
        }

        if($request->has('deleted_images')){
            $deletedImages = $request->input('deleted_images');
            foreach ($deletedImages as $imageName) {
                if(Gallery::deleteImg($imageName))
                    Storage::disk('public')->delete('img/'.$imageName);
                else
                    return redirect()->back()->with('error', 'Ha habido un error al eliminar las imágenes del vehículo.');
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = self::parseImg($image);
                $image->storeAs('img', $imagePath, 'public');
                Gallery::addImage($car->id, $imagePath);
            }
        }
        $galleryChanges = self::validateGalleryChanges($request, $car);
        $changes = array_merge($changes, $galleryChanges);
    
    
        if (Cars::updateCar($car, $changes)) {
            foreach ($request->all() as $key => $value) {
                if (str_starts_with($key, 'fileImg')) {
                    $number = substr($key, 7);
                    $imgField = 'img' . $number;
                    $verificatedImg = Gallery::getImg($request->$imgField);
                    // dd($verificatedImg);
                    if ($request->hasFile($key)) {
                        $image = $request->file($key);
                        $imageName = self::parseImg($image);
                        $image->storeAs('img', $imageName, 'public');
                        if(!Gallery::updateImage($verificatedImg, $imageName)){ return redirect()->back()->with('error', 'Ha habido un error al actualizar la galería del coche.'); }

                        Storage::disk('public')->delete('img/'.$request->$imgField);

                    }
                }
            }
        
            return redirect()->back()->with('success', 'Coche actualizado correctamente.');
        } else {
            return redirect()->back()->with('error', 'Ha habido un error al actualizar el coche.');
        }
    }
    
    private static function validateUpdateCar($request) {
        $rules = [
            'id' => 'required|string|max:255',
            'name' => 'sometimes|string|max:255',
            'brand_id' => 'sometimes|exists:brands,id',
            'type_id' => 'sometimes|exists:types,id',
            'color_id' => 'sometimes|exists:colors,id',
            'horsepower' => 'sometimes|numeric|min:1',
            'year' => 'sometimes|integer|min:1900|max:' . date('Y'),
            'price' => 'sometimes|numeric|min:0',
            'sale' => 'sometimes|boolean',
            'main_img' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];

        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'fileImg')) {
                $rules[$key] = 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
            }
        }
    
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'img')) {
                $rules[$key] = 'sometimes|string|max:255';
            }
        }
    
        $messages = [
            'name.required' => 'El nombre del coche es obligatorio.',
            'brand_id.required' => 'La marca del coche es obligatoria.',
            'type_id.required' => 'El tipo del coche es obligatorio.',
            'color_id.required' => 'El color del coche es obligatorio.',
            'horsepower.required' => 'Los CV del coche son obligatorios.',
            'year.required' => 'El año del coche es obligatorio.',
            'price.required' => 'El precio del coche es obligatorio.',
            'main_img.image' => 'La imagen principal debe ser un archivo de imagen válido.',
            'main_img.max' => 'La imagen principal no debe ser mayor de 2MB.',
            'fileImg*.image' => 'Cada archivo debe ser una imagen válida.',
            'fileImg*.max' => 'Cada archivo no debe ser mayor de 2MB.',
            'deleted_images' => 'sometimes|array',
            'deleted_images.*' => 'sometimes|string|max:255',
            'deleted_images.array' => 'Las imágenes borradas no presentan el formato esperado.',
            'deleted_images.*.string' => 'Cada nombre de imagen borrada debe ser un texto.',
            'deleted_images.*.max' => 'Cada nombre de imagen borrada no debe superar los 255 caracteres.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        return $validator->validated();
    }
    
    private static function validateChanges($validatedData, $car): array {
        $changes = [];
    
        foreach ($validatedData as $key => $value) {
            if ($car->$key != $value) {
                $changes[$key] = $value; 
            }
        }

        return $changes;
    }

    private static function validateGalleryChanges($request, $car): array {
        $changes = [];
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'fileImg')) {
                $number = substr($key, 7);
                $imgField = 'img' . $number;

                if ($request->hasFile($key)) {
                    $image = $request->file($key);
                    $imageName = self::parseImg($image);
                    $image->storeAs('img', $imageName, 'public');

                    $changes[$imgField] = $imageName;

                    if (isset($car->$imgField)) {
                        Storage::disk('public')->delete('img/' . $car->$imgField);
                    }
                }
            }
        }
        return $changes;
    }

    public static function parseImg($img) {
        $timestamp = now()->format('Y-m-d_H-i-s') . '_' . round(microtime(true) * 1000);
        $filename = $timestamp . '_' . $img->getClientOriginalName();
        if(strlen($filename) >= 255){
            $filename = $timestamp;
        }
        return $filename;
    }
}
