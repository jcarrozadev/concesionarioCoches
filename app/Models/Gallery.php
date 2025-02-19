<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $fillable = ['car_id', 'img'];
    
    public static function getImages($id): Collection {
        return self::select('img')
            ->where('gallery.car_id', $id)
            ->get();
    }
}
