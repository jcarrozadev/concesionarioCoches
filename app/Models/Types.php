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

    public static function getType($id): Types {
        return self::find($id);
    }

    public static function addType($data): Types {
        return self::create([
            'name' => $data['name'],
            'enabled' => 1
        ]);
    }

    public static function removeType($id): bool {
        return self::where('id', $id)
                    ->update(['enabled' => 0]) >= 0;
    }
    
    public static function updateType($type, array $changes): bool {
        return $type->update($changes);
    }
}
