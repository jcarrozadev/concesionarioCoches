<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Gallery;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{

    public ?int $id = NULL;
    public ?string $brand_id = NULL;
    public ?string $brand_name = NULL;
    public ?string $type_id = NULL;
    public ?string $type_name = NULL;
    public ?string $color_id = NULL;
    public ?string $color_name = NULL;
    public ?string $hex = NULL;
    public ?string $name = NULL;
    public ?int $year = NULL;
    public ?float $horsepower = NULL;
    public ?float $price = NULL;
    public ?string $main_img = NULL;
    public ?string $sale = NULL;
    public ?Collection $gallery = NULL;


    /**
     * Summary of getCar
     * @param mixed $id
     * @return View
     */
    public function getCar(mixed $id): View {

        $this->setCar(Cars::getCar($id));

        $images = Gallery::getImages($id);


        return view('user.data_sheet')->with(['car' => $this])->with('images', $images);
    }

    /**
     * Summary of setCar
     * @param mixed $car
     * @return void
     */
    private function setCar($car):void {
        $this->id = $car->id;
        $this->brand_id = $car->brand_id;
        $this->brand_name = $car->brand_name;
        $this->type_id = $car->type_id;
        $this->type_name = $car->type_name;
        $this->color_id = $car->color_id;
        $this->color_name = $car->color_name;
        $this->hex = $car->hex;
        $this->name = $car->name;
        $this->year = $car->year;
        $this->horsepower = $car->horsepower;
        $this->price = $car->price;
        $this->main_img = $car->main_img;
        $this->sale = $car->sale;
        $this->gallery = $car->gallery;
    }

    /**
     * Summary of addCar
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function addCar(Request $request): RedirectResponse {

        $data = $request->all();
        
        $utility = New UtilitiesController();
        $validate = new ValidateController();

        $data = $validate->validateCar($request);
        
        if ($data instanceof RedirectResponse) {
            return $data;
        }

        if(!isset($data['sale'])) {
            $data['sale'] = 0;
        }

        $data['main_img'] = $utility->parseImg($request->file('main_img'));
        $request->file('main_img')->storeAs('img', $data['main_img'], 'public');

        try {
            $carId = Cars::addCar($data);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $utility->parseImg($image);
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
    public function removeCar(Request $request): mixed {
        return Cars::removeCar($request->car_id) 
                    ? response()->json(['success' => 'Coche eliminado correctamente.'])
                    : response()->json(['error' => 'Error al eliminar el coche.'], 500);
    }

    /**
     * Summary of updateCar
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function updateCar(Request $request): RedirectResponse {
        
        $validatedData = new ValidateController();
        $utility = New UtilitiesController();
        
        $data = $validatedData->validateUpdateCar($request);
        if ($data instanceof RedirectResponse) {
            return $data;
        }
    
        $car = Cars::getCar($validatedData->validateUpdateCar(['id']));
        if (!$car) {
            redirect()->back()->with('error' , 'No se encuentra el coche seleccionado.');
        }
        $changes = $validatedData->validateChanges($validatedData, $car);
        $galleryChanges = $validatedData->validateGalleryChanges($request, $car);
        $changes = array_merge($changes, $galleryChanges);
        if (empty($changes)) {
            return redirect()->back()->with('error', 'No ha habido cambios.');
        }
        if (isset($changes['main_img'])) {
            $changes['main_img'] = $utility->parseImg($request->file('main_img'));
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
                $imagePath = $utility->parseImg($image);
                $image->storeAs('img', $imagePath, 'public');
                Gallery::addImage($car->id, $imagePath);
            }
        }
        if ($request->hasFile('editImages')) {
            foreach ($request->file('editImages') as $image) {
                $imagePath = $utility->parseImg($image);
                $image->storeAs('img', $imagePath, 'public');
                Gallery::addImage($car->id, $imagePath);
            }
        }
    
    
        if (Cars::updateCar($car, $changes)) {
            foreach ($request->all() as $key => $value) {
                if (str_starts_with($key, 'fileImg')) {
                    $number = substr($key, 7);
                    $imgField = 'img' . $number;
                    $verificatedImg = Gallery::getImg($request->$imgField);
                    // dd($verificatedImg);
                    if ($request->hasFile($key)) {
                        $image = $request->file($key);
                        $imageName = $utility->parseImg($image);
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

    // Getters and Setters

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getBrandId(): ?string {
        return $this->brand_id;
    }

    public function setBrandId(?string $brand_id): void {
        $this->brand_id = $brand_id;
    }

    public function getBrandName(): ?string {
        return $this->brand_name;
    }

    public function setBrandName(?string $brand_name): void {
        $this->brand_name = $brand_name;
    }

    public function getTypeId(): ?string {
        return $this->type_id;
    }

    public function setTypeId(?string $type_id): void {
        $this->type_id = $type_id;
    }

    public function getTypeName(): ?string {
        return $this->type_name;
    }

    public function setTypeName(?string $type_name): void {
        $this->type_name = $type_name;
    }

    public function getColorId(): ?string {
        return $this->color_id;
    }

    public function setColorId(?string $color_id): void {
        $this->color_id = $color_id;
    }

    public function getColorName(): ?string {
        return $this->color_name;
    }

    public function setColorName(?string $color_name): void {
        $this->color_name = $color_name;
    }

    public function getHex(): ?string {
        return $this->hex;
    }

    public function setHex(?string $hex): void {
        $this->hex = $hex;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $name): void {
        $this->name = $name;
    }

    public function getYear(): ?int {
        return $this->year;
    }

    public function setYear(?int $year): void {
        $this->year = $year;
    }

    public function getHorsepower(): ?float {
        return $this->horsepower;
    }

    public function setHorsepower(?float $horsepower): void {
        $this->horsepower = $horsepower;
    }

    public function getPrice(): ?float {
        return $this->price;
    }

    public function setPrice(?float $price): void {
        $this->price = $price;
    }

    public function getMainImg(): ?string {
        return $this->main_img;
    }

    public function setMainImg(?string $main_img): void {
        $this->main_img = $main_img;
    }

    public function getSale(): ?string {
        return $this->sale;
    }

    public function setSale(?string $sale): void {
        $this->sale = $sale;
    }

    public function getGallery(): ?Collection {
        return $this->gallery;
    }

    public function setGallery(?Collection $gallery): void {
        $this->gallery = $gallery;
    }
}
