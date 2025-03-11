<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public ?int $id = NULL;
    public ?string $car_id = NULL;
    public ?string $img = NULL;


    // Getters and Setters

    public function getId(): ?int {
        return $this->id;
    }
    
    public function setId(?int $id): void {
        $this->id = $id;
    }
    
    public function getCarId(): ?string {
        return $this->car_id;
    }
    
    public function setCarId(?string $car_id): void {
        $this->car_id = $car_id;
    }
    
    public function getImg(): ?string {
        return $this->img;
    }
    
    public function setImg(?string $img): void {
        $this->img = $img;
    }
    
}
