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
        return Colors::all()->map(function ($color) {
            return new ColorController($color);
        });
    }

    /**
     * Summary of addColor
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function addColor(ColorAddRequest $request): RedirectResponse {
        return Colors::addColor($request->validated()) 
                    ? redirect()->route('colors')->with('success', 'Color añadido correctamente') 
                    : redirect()->route('colors')->with('error', 'Error al añadir el color');

    }

    /**
     * Summary of removeColor
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function removeColor(Request $request): mixed {
        return Colors::removeColor($request->color_id) 
                    ? response()->json(['success' => 'Color eliminado correctamente.'])
                    : response()->json(['error' => 'Error al eliminar el color.'], 500);
    }

    /**
     * Summary of editColor
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function editColor(ColorUpdateRequest $request): RedirectResponse {
        return Colors::editColor($request->validated()) 
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
