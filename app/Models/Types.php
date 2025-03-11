<?php

namespace App\Models;

use App\Http\Controllers\TypeController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    protected $table = 'types';
    protected $fillable = ['name', 'enabled'];

    /**
     * Summary of getTypesAll
     * @return Collection<int, Types>
     */
    public static function getTypesAll(): Collection {
        return self::where('enabled', 1)
                    ->get();
    }


    /**
     * Summary of addType
     * @param mixed $data
     * @return Types
     */
    public static function addType(TypeController $request): Types {

        return self::create([
            'name' => $request->name,
            'enabled' => 1
        ]);
    }

    /**
     * Summary of removeType
     * @param mixed $id
     * @return bool
     */
    public static function removeType(int $id): bool {
        return self::where('id', $id)
                    ->update(['enabled' => 0]) > 0;
    }
    
    
    public static function updateType(TypeController $request): bool {
    
        $type = self::where('id', $request->id)->first();

        if (!$type) {
            return false;
        }

        $updatedData = [];
    
        if ($type->name !== $request->name && !is_null($request->name)) {
            $updatedData['name'] = $request->name;
        }
    
        if (empty($updatedData)) {
            return false;
        }
    
        return $type->update($updatedData);
    }
}
