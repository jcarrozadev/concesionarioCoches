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

        return Brands::all()->map(function ($brand) {
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
    public function removeBrand(Request $request): mixed {
        $brandDeleted = Brands::removeBrand($request->brand_id);
        
        if ($brandDeleted) {
            return response()->json(['success' => 'Marca eliminada correctamente.']);
        } else {
            return response()->json(['error' => 'Error al eliminar la marca.'], 500);
        }

    }

    /**
     * Summary of compareBrand
     * @param mixed $request
     * @param mixed $validatedData
     * @return array
     */
    private function compareBrand(mixed $request, mixed $validatedData): array {
        $data = $request->all();
        $dataDB = Brands::find($data['id']);
    
        $dataNew = [];

        $dataNew['id'] = $data['id'];
    
        if ($validatedData['name'] !== $dataDB->name) {
            $dataNew['name'] = $validatedData['name'];
        }
    
        return $dataNew;
    }    

    /**
     * Summary of editBrand
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function editBrand(BrandRequest $request): RedirectResponse {
        $validatedData = $request->validated();
        $validatedData['id'] = $request->id;

        $data = self::compareBrand($request, $validatedData);

        if (Brands::editBrand($data)) {
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
