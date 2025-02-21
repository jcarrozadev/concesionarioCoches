<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use App\Models\Types;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class TypesController extends Controller
{
    /**
     * Summary of getTypes
     * @return View
     */
    public static function getTypes(): View {
        return view('admin.types', ['types' => Types::getTypesAll()]);
    }

    public static function addType(Request $request): RedirectResponse {

        $validatedData = self::validateType($request);
    
        if (Types::addType($validatedData)) {
            return redirect()->route('brands')->with('success', 'Marca añadida correctamente');
        } else {
            return redirect()->route('brands')->with('error', 'Error al añadir la marca');
        }
    }

    public static function removeType(Request $request): mixed {
        $typeDeleted = Types::removeType($request->type_id);
        
        if ($typeDeleted) {
            return response()->json(['success' => 'Tipo eliminado correctamente.']);
        } else {
            return response()->json(['error' => 'Error al eliminar el tipo.'], 500);
        }

    }

    private static function validateType(Request $request): array {
        return $request->validate([
            'name' => 'required|string',
        ]);
    }
}
