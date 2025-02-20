<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    protected $table = 'types';
    protected $fillable = ['name', 'enabled'];

    public static function getTypesAll(): Collection {
        return self::where('enabled', 1)
                    ->get();
    }
}
