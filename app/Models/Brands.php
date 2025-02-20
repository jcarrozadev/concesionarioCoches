<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table = 'brands';
    protected $fillable = ['name', 'enabled'];

    /**
     * Summary of getBrandsAll
     * @return Collection<int, Brands>
     */
    public static function getBrandsAll(): Collection {
        return self::where('enabled', 1)
                    ->get();
    }
}
