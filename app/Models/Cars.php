<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    protected $table = 'cars';
    protected $fillable = ['name', 'year', 'brand_id', 'type_id', 'color_id','horsepower', 'enabled', 'sale', 'price', 'main_img'];

    public static function getCarsAll():Collection {
        return self::select('cars.*', 'brands.name as brand_name', 'types.name as type_name', 'colors.name as color_name')
                    ->join('brands', 'cars.brand_id', '=', 'brands.id')
                    ->join('types', 'cars.type_id', '=', 'types.id')
                    ->join('colors', 'cars.color_id', '=', 'colors.id')
                    ->where('cars.enabled', 1)
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

    public static function addCar($data): Cars {
        return self::create([
            'name' => $data['name'],
            'year' => $data['year'],
            'horsepower' => $data['horsepower'],
            'sale' => $data['sale'],
            'brand_id' => $data['brand_id'],
            'type_id' => $data['type_id'],
            'color_id' => $data['color_id'],
            'price' => $data['price'],
            'enabled' => 1,
            'main_img' => $data['main_img']
        ]);
    }

    public static function removeCar($id): bool {
        return self::where('id', $id)->update(['enabled' => 0]);
    }

    public static function getCar($id): Cars {
        return self::select('cars.*', 'brands.name as brand_name', 'types.name as type_name', 'colors.name as color_name', 'colors.hex as hex')
            ->join('brands', 'cars.brand_id', '=', 'brands.id')
            ->join('types', 'cars.type_id', '=', 'types.id')
            ->join('colors', 'cars.color_id', '=', 'colors.id')
            ->where('cars.id', $id) 
            ->first();
    }

    public static function removeCarsWithBrand($id): bool {
        return self::where('brand_id', $id)
                    ->update(['enabled' => 0]) >= 0;
    }
    
    public static function getCarsWithBrand($id): Collection {
        return self::select('brands.name as brand_name', 'cars.name as name')
                    ->where('brand_id', $id) 
                    ->join('brands', 'cars.brand_id', '=', 'brands.id')
                    ->get();
    }
}
