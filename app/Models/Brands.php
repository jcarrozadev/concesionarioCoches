<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast\Bool_;

class Brands extends Model
{
    protected $table = 'brands';
    protected $fillable = ['name', 'enabled'];

    public static function getBrandsAll(): Collection {
        return self::where('enabled', 1)
                    ->get();
    }
    
    public static function removeBrand($id): bool {
        return self::where('id', $id)
                    ->update(['enabled' => 0]) >= 0;
    }
    
    public static function addBrand($data): Brands {
        return self::create([
            'name' => $data['name'],
            'enabled' => 1
        ]);
    }
}
