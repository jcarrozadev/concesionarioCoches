<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use Illuminate\Contracts\View\View;
use App\Models\Types;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TypeController extends Controller
{

    public ?int $id = NULL;
    
    public ?string $name = NULL;
    

    public function __construct(?Types $type = null) {
        if ($type) {
            $this->id = $type->id;
            $this->name = $type->name;
        }
    }

    public function getTypes(): Collection {

        return Types::getTypesAll()->map(function ($type) {
            return new TypeController($type);
        });
        
    }

    /**
     * Summary of addType
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function addType(TypeRequest $request): RedirectResponse {

        $data = $request->validated();
        $this->name = $data['name'];
        
        if (Types::addType($this)) {
            return redirect()->route('types')->with('success', 'Tipo añadido correctamente');
        } else {
            return redirect()->route('types')->with('error', 'Error al añadir el tipo');
        }
    }

    /**
     * Summary of removeType
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function removeType(): mixed {
        $id = request()->input('type_id');
        if (!isset($id)) {
            return response()->json(['error' => 'ID de tipo no proporcionado.'], 400);
        }
        $this->id = $id;

        if (Types::removeType($this->id)) {
            return response()->json(['success' => 'Tipo eliminado correctamente.']);
        } else {
            return response()->json(['error' => 'Error al eliminar el tipo.'], 500);
        }
    }

    /**
     * Summary of updateType
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function updateType(TypeRequest $request): RedirectResponse{
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


        return Types::updateType($this) ? redirect()->back()->with('success', 'Tipo actualizado correctamente.') : redirect()->back()->with('error' , 'Ha habido un error al actualizar el tipo.');
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
