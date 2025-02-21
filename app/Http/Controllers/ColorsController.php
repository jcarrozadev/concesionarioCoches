<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Colors;

class ColorsController extends Controller
{
    /**
     * Summary of getColors
     * @return View
     */
    public static function getColors(): View {
        return view('admin.colors', ['colors' => Colors::getColorsAll()]);
    }

    /**
     * Summary of addColor
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public static function addColor(Request $request): RedirectResponse {
        $data = $request->all();

        $data = $request->validate([
            'name' => 'required|string',
            'hex' => 'required|string'
        ]);

        return Colors::addColor($data) 
                    ? redirect()->route('colors')->with('success', 'Color añadido correctamente') 
                    : redirect()->route('colors')->with('error', 'Error al añadir el color');

    }

    /**
     * Summary of removeColor
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public static function removeColor(Request $request): mixed {
        return Colors::removeColor($request->color_id) 
                    ? response()->json(['success' => 'Color eliminado correctamente.'])
                    : response()->json(['error' => 'Error al eliminar el color.'], 500);
    }
}
