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
    
    /**
     * Summary of removeBrand
     * @param mixed $id
     * @return bool
     */
    public static function removeBrand(mixed $id): bool {
        return self::where('id', $id)
                    ->update(['enabled' => 0]) >= 0;
    }
    
    public static function addBrand(BrandController $request): Brands {
        return self::create([
            'name' => $request->name,
            'enabled' => 1
        ]);
    }

    /**
     * Summary of editBrand
     * @param mixed $data
     * @return bool
     */
    public static function editBrand(mixed $data):bool {
        $id = $data['id'];
        unset($data['id']);
        
        return self::where('id', $id)
        ->update($data);
    }
}
