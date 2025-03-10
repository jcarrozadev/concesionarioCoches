<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarAddRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return true; 
    // }

    public function rules():array
    {
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

        foreach ($this->all() as $key => $value) {
            if (str_starts_with($key, 'images')) {
                $rules[$key] = 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
            }
        }

        return $rules;
    }

    public function messages():array
    {
        return [
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
    }
}
