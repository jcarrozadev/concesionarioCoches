<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarAddRequest;
use App\Http\Requests\CarUpdateRequest;
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
    public BrandController $brand;
    public TypeController $type;
    public ColorController $color;
    public ?Collection $gallery = NULL;
    public ?string $name = NULL;
    public ?int $year = NULL;
    public ?float $horsepower = NULL;
    public ?float $price = NULL;
    public ?string $main_img = NULL;
    public ?string $sale = NULL;
    

    public function __construct() {
        $this->brand = New BrandController();
        $this->type = New TypeController();
        $this->color = New ColorController();
    }

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
        $this->brand->id = $car->brand_id;
        $this->brand->name = $car->brand_name;
        $this->type->id = $car->type_id;
        $this->type->name = $car->type_name;
        $this->color->id = $car->color_id;
        $this->color->name = $car->color_name;
        $this->color->hex = $car->hex;
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
     * @param CarAddRequest $request
     * @return RedirectResponse
     */
    public function addCar(CarAddRequest $request): RedirectResponse {


        $car = $this->createAddRequest($request);

        if($car){
            return redirect()->route('admin')->with('success', 'Vehículo añadido correctamente');
        }

        return redirect()->route('admin')->with('error', 'Error al añadir el vehículo');
        

    }

    private function createAddRequest(CarAddRequest $request): bool{

        $data = $request->validated();   
        $utility = New UtilitiesController();

        $this->name = $data['name'];
        $this->year = $data['year'];
        $this->horsepower=$data['horsepower'];
        $this->price = $data['price'];
        $this->sale = $data['sale'] ?? 0;
        $this->brand->id = $data['brand_id'];
        $this->type->id = $data['type_id'];
        $this->color->id = $data['color_id'];


        $data['main_img'] = $utility->parseImg($request->file('main_img'));
        $this->main_img = $data['main_img'];
        $request->file('main_img')->storeAs('img', $data['main_img'], 'public');

        $carId = Cars::addCar($this);

        if($carId){
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $utility->parseImg($image);
                    $image->storeAs('img', $imagePath, 'public');
                    $imgGallery = new GalleryController();
                    $imgGallery->car_id = $carId;
                    $imgGallery->img = $imagePath;

                    Gallery::addImage($carId, $imgGallery->img);
                }
            }
        }else{
            return false;
        }

        return true;
    }

    /**
     * Summary of removeCar
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function removeCar(): mixed {
        
        $this->id = Request::input('car_id');

        return Cars::removeCar($this->id) 
                    ? response()->json(['success' => 'Coche eliminado correctamente.'])
                    : response()->json(['error' => 'Error al eliminar el coche.'], 500);
    }

    /**
     * Summary of updateCar
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function updateCar(CarUpdateRequest $request): RedirectResponse {
        $utility = New UtilitiesController();


        return $this->createUpdateRequest($request) ?  redirect()->back()->with('success', 'Coche actualizado correctamente.'): 
                        redirect()->back()->with('error', 'Ha habido un error al actualizar el coche.');

    }

    private function createUpdateRequest($request): bool{
        $validatedData = $request->validated();
        $validateController = new ValidateController();
        
        if ($validatedData instanceof RedirectResponse) {
            return false;
        }
    
        $car = Cars::getCar($validatedData['id']);
        if (!$car) {
            return false;
        }
        $this->id = $car->id;

        $changes = $validateController->validateChanges($validatedData, $car); 

        $galleryChanges = $validateController->validateGalleryChanges($request, $car); 
        $changes = array_merge($changes, $galleryChanges);
        if (empty($changes)) {
            return false;
        }

        $this->setChangesToCar($changes, $request, $car);

        if($request->has('deleted_images')){
            $deletedImages = $request->input('deleted_images');
            foreach ($deletedImages as $imageName) {
                $imgGallery = new GalleryController();
                $imgGallery->img = $imageName;
                if(Gallery::deleteImg($imgGallery->img))
                    Storage::disk('public')->delete('img/'.$imageName);
                else
                    return false;
            }
        }
        $utility = new UtilitiesController();
        if ($request->hasFile('images')) {
            
            foreach ($request->file('images') as $image) {
                $imgGallery = new GalleryController();
                $imagePath = $utility->parseImg($image);
                $image->storeAs('img', $imagePath, 'public');
                $imgGallery->img = $imagePath;
                Gallery::addImage($this->id, $imgGallery->img);
            }
        }
        if ($request->hasFile('editImages')) {
            foreach ($request->file('editImages') as $image) {
                $imgGallery = new GalleryController();
                $imagePath = $utility->parseImg($image);
                $image->storeAs('img', $imagePath, 'public');
                $imgGallery->img = $imagePath;
                Gallery::addImage($this->id, $imgGallery->img);
            }
        }
    
    
        if (Cars::updateCar($car, $this)) {
            foreach ($request->all() as $key => $value) {
                if (str_starts_with($key, 'fileImg')) {
                    $imgGallery = new GalleryController();
                    $number = substr($key, 7);
                    $imgField = 'img' . $number;
                    $imgGallery->img = $request->imgField;
                    $verificatedImg = Gallery::getImg($imgGallery->img);
                    if ($request->hasFile($key)) {
                        $image = $request->file($key);
                        $imageName = $utility->parseImg($image);
                        $imgGallery->img = $imageName;
                        $image->storeAs('img', $imageName, 'public');
                        if(!Gallery::updateImage($verificatedImg, $imgGallery)) 
                            return false; 

                        Storage::disk('public')->delete('img/'.$request->$imgField);
                    }
                }
            }
        }
        return true;
    }

    private function setChangesToCar(array $changes, CarUpdateRequest $request, Cars $car): void{
        foreach ($changes as $key => $value) {
            switch ($key) {
                case 'main_img':
                    $utility = new UtilitiesController();
                    $value = $utility->parseImg($request->file('main_img'));
                    $request->file('main_img')->storeAs('img', $value, 'public');
                    Storage::disk('public')->delete('img/'.$car->main_img);
                    $this->main_img = $value;
                    break;
    
                case 'name':
                    $this->name = $value;
                    break;
    
                case 'year':
                    $this->year = $value;
                    break;
    
                case 'horsepower':
                    $this->horsepower = $value;
                    break;
    
                case 'price':
                    $this->price = $value;
                    break;
    
                case 'sale':
                    $this->sale = $value;
                    break;
    
                case 'brand_id':
                    $this->brand->id = $value;
                    break;
    
                case 'type_id':
                    $this->type->id = $value;
                    break;
    
                case 'color_id':
                    $this->color->id = $value;
                    break;
    
                default:
                    break;
            }
        }    
    }

    // Getters and Setters

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
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
