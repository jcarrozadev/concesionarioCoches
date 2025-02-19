<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    protected $table = 'cars';
    protected $fillable = ['name', 'year', 'horsepower', 'sale', 'enabled', 'main_img'];

    public static function getCarsAll() {
        return self::all();
    }

    public static function getCarsOffers(){
        return self::where('sale', 1)
                    ->where('enabled', 1)
                    ->get();
    }

    public static function getCarsNotOffers(){
        return self::where('sale', 0)
                    ->where('enabled', 1)
                    ->get();
    }
}
