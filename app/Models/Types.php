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

    public static function removeType($id): bool {
        return self::where('id', $id)
                    ->update(['enabled' => 0]) >= 0;
    }
}
