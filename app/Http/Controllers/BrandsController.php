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
}
