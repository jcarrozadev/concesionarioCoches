<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use App\Models\Types;
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

    public static function removeType(Request $request): mixed {
        $typeDeleted = Types::removeType($request->type_id);
        
        if ($typeDeleted) {
            return response()->json(['success' => 'Tipo eliminado correctamente.']);
        } else {
            return response()->json(['error' => 'Error al eliminar el tipo.'], 500);
        }

    }
}
