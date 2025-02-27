<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cars extends Model
{
    protected $table = 'cars';
    protected $fillable = ['name', 'year', 'brand_id', 'type_id', 'color_id','horsepower', 'enabled', 'sale', 'price', 'main_img'];

    /**
     * Summary of getCarsAll
     * @return Collection<int, Cars>
     */
    public static function getCarsAll(): Collection {
        return self::with('gallery')
            ->join('brands', 'cars.brand_id', '=', 'brands.id')
            ->join('types', 'cars.type_id', '=', 'types.id')
            ->join('colors', 'cars.color_id', '=', 'colors.id')
            ->where('cars.enabled', 1)
            ->select('cars.*', 'brands.id as brand_id', 'brands.name as brand_name', 'types.id as type_id', 'types.name as type_name', 'colors.id as color_id', 'colors.name as color_name', 'colors.hex as color_hex')
            ->get();
    }

    /**
     * Summary of getCarsOffers
     * @return Collection<int, Cars>
     */
    public static function getCarsOffers():Collection{
        return self::select('cars.*', 'brands.name as brand_name', 'types.name as type_name', 'colors.name as color_name', 'colors.hex as color_hex')
                    ->join('brands', 'cars.brand_id', '=', 'brands.id')
                    ->join('types', 'cars.type_id', '=', 'types.id')
                    ->join('colors', 'cars.color_id', '=', 'colors.id')
                    ->where('cars.sale', 1)
                    ->where('cars.enabled', 1)
                    ->get();
    }

    /**
     * Summary of getCarsNotOffers
     * @return Collection<int, Cars>
     */
    public static function getCarsNotOffers():Collection{
        return self::select('cars.*', 'brands.name as brand_name', 'types.name as type_name', 'colors.name as color_name', 'colors.hex as color_hex')
                    ->join('brands', 'cars.brand_id', '=', 'brands.id')
                    ->join('types', 'cars.type_id', '=', 'types.id')
                    ->join('colors', 'cars.color_id', '=', 'colors.id')
                    ->where('cars.sale', 0)
                    ->where('cars.enabled', 1)
                    ->get();
    }

    /**
     * Summary of getCar
     * @param mixed $id
     * @return Cars|null
     */
    public static function getCar($id): Cars {
        return self::select('cars.*', 'brands.name as brand_name', 'types.name as type_name', 'colors.name as color_name', 'colors.hex as hex')
            ->join('brands', 'cars.brand_id', '=', 'brands.id')
            ->join('types', 'cars.type_id', '=', 'types.id')
            ->join('colors', 'cars.color_id', '=', 'colors.id')
            ->where('cars.id', $id)
            ->with('gallery')
            ->first();
    }

    public static function getCarsWithBrand($id): Collection {
        return self::select('brands.name as brand_name', 'cars.name as name')
                    ->where('brand_id', $id) 
                    ->join('brands', 'cars.brand_id', '=', 'brands.id')
                    ->get();
    }

    /**
     * Summary of addCar
     * @param mixed $data
     * @return Cars
     */
    public static function addCar(array $data): int {
        $car = self::create([
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

        return $car->id;
    }

    /**
     * Summary of removeCar
     * @param mixed $id
     * @return bool
     */
    public static function removeCar($id): bool {
        return self::where('id', $id)->update(['enabled' => 0]);
    }

    /**
     * Summary of updateCar
     * @param mixed $car
     * @param array $changes
     * @return bool
     */
    public static function updateCar($car, array $changes): bool {
        return $car->update($changes);
    }

    /**
     * Summary of getCarsWithType
     * @param mixed $id
     * @return Collection<int, Cars>
     */
    public static function getCarsWithType($id): Collection {
        return self::select('types.name as type_name', 'cars.name as name')
                    ->where('type_id', $id) 
                    ->join('types', 'cars.type_id', '=', 'types.id')
                    ->get();
    }
    
    /**
     * Summary of gallery
     * @return HasMany<Gallery, Cars>
     */
    public function gallery(): HasMany
    {
        return $this->hasMany(Gallery::class, 'car_id');
    }
    
}
