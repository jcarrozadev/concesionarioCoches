<?php

namespace App\Models;

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
     * Summary of getType
     * @param mixed $id
     * @return Collection<int, Types>
     */
    public static function getType($id): Types {
        return self::find($id);
    }

    /**
     * Summary of addType
     * @param mixed $data
     * @return Types
     */
    public static function addType($data): Types {
        return self::create([
            'name' => $data['name'],
            'enabled' => 1
        ]);
    }

    /**
     * Summary of removeType
     * @param mixed $id
     * @return bool
     */
    public static function removeType($id): bool {
        return self::where('id', $id)
                    ->update(['enabled' => 0]) >= 0;
    }
    
    /**
     * Summary of updateType
     * @param mixed $type
     * @param array $changes
     * @return bool
     */
    public static function updateType($type, array $changes): bool {
        return $type->update($changes);
    }
}
