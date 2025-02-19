<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table = 'brands';
    protected $fillable = ['name', 'enabled'];

    public static function getBrandsAll() {
        return self::all();
    }
}
