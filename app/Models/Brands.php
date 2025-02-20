<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table = 'brands';
    protected $fillable = ['name', 'enabled'];

    public static function getBrands(): Collection {
        return self::where('enabled', 1)
                    ->get();
    }
}
