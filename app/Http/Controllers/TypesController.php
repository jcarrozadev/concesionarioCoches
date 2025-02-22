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
            return redirect()->route('types')->with('success', 'Tipo añadido correctamente');
        } else {
            return redirect()->route('types')->with('error', 'Error al añadir el tipo');
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

    public static function updateType(Request $request): RedirectResponse{
        if(!$validatedData = self::validateType($request)){
            return redirect()->back()->with('error' , 'Los valores introducidos no son correctos.');
        }
        
        $type = Types::getType($request->id);

        if(!$type){
            return redirect()->back()->with('error' , 'No se encuentra el tipo seleccionado.');
        }
        $changes = self::validateChanges($validatedData, $type);
        
        if (empty($changes)) {
            return redirect()->back()->with('error', 'No hay nada que actualizar.');
        }

        return Types::updateType($type, $changes) ? redirect()->back()->with('success', 'Tipo actualizado correctamente.') : redirect()->back()->with('error' , 'Ha habido un error al actualizar el tipo.');
    }

    private static function validateType(Request $request): array {
        return $request->validate([
            'id' => 'sometimes|string',
            'name' => 'required|string',
        ],[
            'name.required' => 'El nombre del tipo es obligatorio.'
        ]);
    }

    private static function validateChanges($validatedData, $type): array | bool {
        $changes = [];

        foreach ($validatedData as $key => $value) {
            if ($type->$key != $value) {
                $changes[$key] = $value; 
            }
        }

        return $changes;
    }

}
