<?php

namespace App\Http\Controllers;


use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ValidateController extends Controller
{
    // Cars validates

    public function validateCar(mixed $request): array | RedirectResponse {
        $rules = [
            'name' => 'required|string',
            'brand_id' => 'required|integer',
            'type_id' => 'required|integer',
            'color_id' => 'required|integer',
            'year' => 'required|integer',
            'main_img' => 'required|file',
            'horsepower' => 'required|numeric',
            'price' => 'required|numeric'
        ];

        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'images')) {
                $rules[$key] = 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
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
            'img*.image' => 'Cada archivo debe ser una imagen válida.',
            'img*.max' => 'Cada archivo no debe ser mayor de 2MB.',
            'editImages.array' => 'Las imágenes adicionales no presentan el formato esperado.',
            'editImages.*.image' => 'Cada imagen adicional debe ser un archivo de imagen válido.',
            'editImages.*.max' => 'Cada imagen adicional no debe ser mayor de 2MB.',
            'deleted_images.array' => 'Las imágenes borradas no presentan el formato esperado.',
            'deleted_images.*.string' => 'Cada nombre de imagen borrada debe ser un texto.',
            'deleted_images.*.max' => 'Cada nombre de imagen borrada no debe superar los 255 caracteres.',
        ];
        $messages = [
            'name.required' => 'El nombre del coche es obligatorio.',
            'brand_id.required' => 'La marca del coche es obligatoria.',
            'type_id.required' => 'El tipo del coche es obligatorio.',
            'color_id.required' => 'El color del coche es obligatorio.',
            'year.required' => 'El año del coche es obligatorio.',
            'main_img.required' => 'La imagen principal es obligatoria.',
            'horsepower.required' => 'Los CV del coche son obligatorios.',
            'price.required' => 'El precio del coche es obligatorio.',
    
            'name.string' => 'El nombre del coche debe ser una cadena de texto.',
            'brand_id.integer' => 'La marca del coche debe ser un número entero.',
            'type_id.integer' => 'El tipo del coche debe ser un número entero.',
            'color_id.integer' => 'El color del coche debe ser un número entero.',
            'year.integer' => 'El año del coche debe ser un número entero.',
            'horsepower.numeric' => 'Los CV del coche deben ser un número.',
            'price.numeric' => 'El precio del coche debe ser un número.',
    
            'main_img.file' => 'La imagen principal debe ser un archivo válido.',
    
            'images*.image' => 'El archivo :attribute debe ser una imagen válida.',
            'images*.mimes' => 'El archivo :attribute debe ser de tipo: jpeg, png, jpg, gif o webp.',
            'images*.max' => 'El archivo :attribute no debe ser mayor de 2MB.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
    
        return $validator->validated();
    }

    /**
     * Summary of validateUpdateCar
     * @param mixed $request
     * @return array|RedirectResponse
     */
    public function validateUpdateCar(mixed $request): array|RedirectResponse {
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
            'editImages' => 'sometimes|array',
            'editImages.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'deleted_images' => 'sometimes|array',
            'deleted_images.*' => 'sometimes|string|max:255',
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
            'img*.image' => 'Cada archivo debe ser una imagen válida.',
            'img*.max' => 'Cada archivo no debe ser mayor de 2MB.',
            'editImages.array' => 'Las imágenes adicionales no presentan el formato esperado.',
            'editImages.*.image' => 'Cada imagen adicional debe ser un archivo de imagen válido.',
            'editImages.*.max' => 'Cada imagen adicional no debe ser mayor de 2MB.',
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


    
    /**
     * Summary of validateChanges
     * @param mixed $validatedData
     * @param mixed $car
     * @return array
     */
    public function validateChanges(mixed $validatedData, mixed $car): array {
        $changes = [];
    
        foreach ($validatedData as $key => $value) {
            if ($car->$key != $value) {
                $changes[$key] = $value; 
            }
        } 
        $onlyImgKeys = true;
        foreach ($changes as $key => $value) {
            if (!str_starts_with($key, 'img')) {
                $onlyImgKeys = false;
            }
        }
    
    
        if ($onlyImgKeys) {
            return [];
        }
    
        return $changes;
    }

    /**
     * Summary of validateGalleryChanges
     * @param mixed $request
     * @param mixed $car
     * @return string[]
     */
    public function validateGalleryChanges(mixed $request, mixed $car): array {
        $changes = [];

        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'fileImg')) {
                $number = substr($key, 7);
                $imgField = 'img' . $number;
                $utility = New UtilitiesController();

                if ($request->hasFile($key)) {
                    $image = $request->file($key);
                    $imageName = $utility->parseImg($image);
                    $image->storeAs('img', $imageName, 'public');

                    $changes[$imgField] = $imageName;

                    if (isset($car->$imgField)) {
                        Storage::disk('public')->delete('img/' . $car->$imgField);
                    }
                }
            }
        }
        if ($request->hasFile('editImages')) {
            foreach ($request->file('editImages') as $index => $image) {
                $imageName = $utility->parseImg($image);
                $image->storeAs('img', $imageName, 'public');
    
                $changes['editImages'][$index] = $imageName;
            }
        }
        return $changes;
    }

    
}
