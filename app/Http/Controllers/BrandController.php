<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Models\Brands;
use Illuminate\Support\Collection;

class BrandController extends Controller
{

    public ?int $id = NULL;
    
    public ?string $name = NULL;

    public function __construct(?Brands $brand = null) {
        if ($brand) {
            $this->id = $brand->id;
            $this->name = $brand->name;
        }
    }

    public function getBrands(): Collection {

        return Brands::getBrandsAll()->map(function ($brand) {
            return new BrandController($brand);
        });
        
    }

    /**
     * Summary of addBrand
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function addBrand(BrandRequest $request): RedirectResponse {
        $data = $request->validated();

        $this->name = $data['name'];
        
        if (Brands::addBrand($this)) {
            return redirect()->route('brands')->with('success', 'Marca añadida correctamente');
        } else {
            return redirect()->route('brands')->with('error', 'Error al añadir la marca');
        }
    }

    /**
     * Summary of removeBrand
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function removeBrand(): mixed {
        
        $id = request()->input('brand_id');
        if(!isset($id))
            return response()->json(['error' => 'Error al eliminar la marca.'], 500);
        
        $this->id = $id;
        
        if (Brands::removeBrand($this)) {
            return response()->json(['success' => 'Marca eliminada correctamente.']);
        } else {
            return response()->json(['error' => 'Error al eliminar la marca.'], 500);
        }

    }

    public function editBrand(BrandRequest $request): RedirectResponse {
        $validatedData = $request->validated();
        $validatedData['id'] = $request->id;

        if(!$validatedData = $request->validated()){
            return redirect()->back()->with('error' , 'Los valores introducidos no son correctos.');
        }

        if(isset($request->id))
            $this->id = $request->id;
        else
            return redirect()->back()->with('error' , 'Error inseperado.');

        if(isset($request->name))
            $this->name = $request->name;
        else
            return redirect()->back()->with('error' , 'Error inseperado.');

        if (Brands::editBrand($this)) {
            return redirect()->route('brands')->with('success', 'Marca editada correctamente');
        } else {
            return redirect()->route('brands')->with('error', 'Error al editar la marca');
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
}
