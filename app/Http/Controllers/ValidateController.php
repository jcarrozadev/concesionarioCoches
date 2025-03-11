<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;

class ValidateController extends Controller
{
    // Cars validates


    
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
        $utility = New UtilitiesController();
        
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'fileImg')) {
                $number = substr($key, 7);
                $imgField = 'img' . $number;
                

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
