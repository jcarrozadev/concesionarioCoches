<?php

namespace App\Models;

use App\Http\Controllers\BrandController;
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

    public static function getBrand(int $id): Brands {
        return self::where('id', $id)
                    ->first();
    }
    
    /**
     * Summary of removeBrand
     * @param mixed $id
     * @return bool
     */
    public static function removeBrand(BrandController $request): bool {
        return self::where('id', $request->id)
                    ->update(['enabled' => 0]) >= 0;
    }
    
    public static function addBrand(BrandController $request): Brands {
        return self::create([
            'name' => $request->name,
            'enabled' => 1
        ]);
    }

    public static function editBrand(BrandController $request): bool {

        $brand = self::where('id', $request->id)->first();

        if (!$brand) {
            return false;
        }
    
        $updatedData = [];
    
        if ($brand->name !== $request->name && !is_null($request->name)) {
            $updatedData['name'] = $request->name;
        }
        
    
        if (empty($updatedData)) {
            return false;
        }
    
        return $brand->update($updatedData);

    }
}
