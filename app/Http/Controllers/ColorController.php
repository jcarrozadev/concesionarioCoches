<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColorAddRequest;
use App\Http\Requests\ColorUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Colors;
use Illuminate\Support\Collection;

class ColorController extends Controller
{


    public ?int $id = NULL;
    
    public ?string $name = NULL;
    public ?string $hex = NULL;
    
    public function __construct(?Colors $color = null) {
        if ($color) {
            $this->id = $color->id;
            $this->name = $color->name;
            $this->hex = $color->hex;
        }
    }
    
    public function getColors(): Collection{
        return Colors::getColorsAll()->map(function ($color) {
            return new ColorController($color);
        });
    }

    /**
     * Summary of addColor
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function addColor(ColorAddRequest $request): RedirectResponse {

        $data = $request->validated();
        $this->name = $data['name'];
        $this->hex = $data['hex'];

        return Colors::addColor($this) 
                    ? redirect()->route('colors')->with('success', 'Color añadido correctamente') 
                    : redirect()->route('colors')->with('error', 'Error al añadir el color');

    }

    public function removeColor(): mixed {

        $this->id = request()->input('color_id');

        return Colors::removeColor($this) 
                    ? response()->json(['success' => 'Color eliminado correctamente.'])
                    : response()->json(['error' => 'Error al eliminar el color.'], 500);
    }

    /**
     * Summary of editColor
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function editColor(ColorUpdateRequest $request): RedirectResponse {

        $request->validated();
        $this->id = $request->id;
        $this->name = $request->name;
        $this->hex = $request->hex;


        return Colors::editColor($this) 
                    ? redirect()->route('colors')->with('success', 'Color editado correctamente.')
                    : redirect()->route('colors')->with('error', 'Error al editar el color.');
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
    public function getHex(): ?string {
        return $this->name;
    }

    public function setHex(?string $hex): void {
        $this->hex = $hex;
    }
}
