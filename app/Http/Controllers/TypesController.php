<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use App\Models\Types;

class TypesController extends Controller
{
    /**
     * Summary of getTypes
     * @return View
     */
    public static function getTypes(): View {
        return view('admin.types', ['types' => Types::getTypesAll()]);
    }
}
