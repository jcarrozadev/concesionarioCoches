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

        return Types::all()->map(function ($type) {
            return new TypeController($type);
        });
        
    }

    /**
     * Summary of addType
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function addType(TypeRequest $request): RedirectResponse {
        if (Types::addType($request->validated())) {
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
    public function removeType(Request $request): mixed {
        $typeDeleted = Types::removeType($request->type_id);
        
        if ($typeDeleted) {
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

    /**
     * Summary of validateChanges
     * @param mixed $validatedData
     * @param mixed $type
     * @return array
     */
    private function validateChanges($validatedData, $type): array | bool {
        $changes = [];

        foreach ($validatedData as $key => $value) {
            if ($type->$key != $value) {
                $changes[$key] = $value; 
            }
        }

        return $changes;
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
