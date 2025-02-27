<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Models\Brands;

class BrandsController extends Controller
{
    /**
     * Summary of getBrands
     * @return View
     */
    public static function getBrands(): View {
        return view('admin.brands', ['brands' => Brands::getBrandsAll()]);
    }

    /**
     * Summary of removeBrand
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public static function removeBrand(Request $request): mixed {
        $brandDeleted = Brands::removeBrand($request->brand_id);
        
        if ($brandDeleted) {
            return response()->json(['success' => 'Marca eliminada correctamente.']);
        } else {
            return response()->json(['error' => 'Error al eliminar la marca.'], 500);
        }

    }

    /**
     * Summary of addBrand
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public static function addBrand(Request $request): RedirectResponse {

        $validatedData = self::validateBrand($request);
    
        if (Brands::addBrand($validatedData)) {
            return redirect()->route('brands')->with('success', 'Marca añadida correctamente');
        } else {
            return redirect()->route('brands')->with('error', 'Error al añadir la marca');
        }
    }

    public static function addType(Request $request): RedirectResponse {

        $validatedData = self::validateBrand($request);
    
        if (Brands::addBrand($validatedData)) {
            return redirect()->route('brands')->with('success', 'Marca añadida correctamente');
        } else {
            return redirect()->route('brands')->with('error', 'Error al añadir la marca');
        }
    }
    
    /**
     * Summary of validateBrand
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    private static function validateBrand(Request $request): array {
        return $request->validate([
            'name' => 'required|string',
        ]);
    }

    /**
     * Summary of compareBrand
     * @param mixed $request
     * @param mixed $validatedData
     * @return array
     */
    private static function compareBrand(mixed $request, mixed $validatedData): array {
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
    public static function editBrand(Request $request): RedirectResponse {
        $validatedData = self::validateBrand($request);
        $validatedData['id'] = $request->id;

        $data = self::compareBrand($request, $validatedData);

        if (Brands::editBrand($data)) {
            return redirect()->route('brands')->with('success', 'Marca editada correctamente');
        } else {
            return redirect()->route('brands')->with('error', 'Error al editar la marca');
        }
    }
}
