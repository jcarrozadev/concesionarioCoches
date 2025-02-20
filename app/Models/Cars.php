<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    protected $table = 'cars';
    protected $fillable = ['name', 'year', 'horsepower', 'sale', 'enabled', 'main_img'];

    public static function getCarsAll():Collection {
        return self::select('cars.*', 'brands.name as brand_name', 'types.name as type_name', 'colors.name as color_name')
                    ->join('brands', 'cars.brand_id', '=', 'brands.id')
                    ->join('types', 'cars.type_id', '=', 'types.id')
                    ->join('colors', 'cars.color_id', '=', 'colors.id')
                    ->get();
    }

    public static function getCarsOffers():Collection{
        return self::select('cars.*', 'brands.name as brand_name', 'types.name as type_name', 'colors.name as color_name')
                    ->join('brands', 'cars.brand_id', '=', 'brands.id')
                    ->join('types', 'cars.type_id', '=', 'types.id')
                    ->join('colors', 'cars.color_id', '=', 'colors.id')
                    ->where('cars.sale', 1)
                    ->where('cars.enabled', 1)
                    ->get();
    }

    public static function getCarsNotOffers():Collection{
        return self::select('cars.*', 'brands.name as brand_name', 'types.name as type_name', 'colors.name as color_name')
                    ->join('brands', 'cars.brand_id', '=', 'brands.id')
                    ->join('types', 'cars.type_id', '=', 'types.id')
                    ->join('colors', 'cars.color_id', '=', 'colors.id')
                    ->where('cars.sale', 0)
                    ->where('cars.enabled', 1)
                    ->get();
    }

    public static function getCar($id): Cars {
        return self::select('cars.*', 'brands.name as brand_name', 'types.name as type_name', 'colors.name as color_name', 'colors.hex as hex')
            ->join('brands', 'cars.brand_id', '=', 'brands.id')
            ->join('types', 'cars.type_id', '=', 'types.id')
            ->join('colors', 'cars.color_id', '=', 'colors.id')
            ->where('cars.id', $id)
            ->first();
    }
}
