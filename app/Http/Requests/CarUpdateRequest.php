<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarUpdateRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return true;
    // }

    public function rules()
    {
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

        foreach ($this->all() as $key => $value) {
            if (str_starts_with($key, 'fileImg')) {
                $rules[$key] = 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
            }
        }
    
        foreach ($this->all() as $key => $value) {
            if (str_starts_with($key, 'img')) {
                $rules[$key] = 'sometimes|string|max:255';
            }
        }

        return $rules;
    }

    public function messages() {
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
