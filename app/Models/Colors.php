<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    protected $table = 'colors';
    protected $fillable = ['name', 'enabled'];

    public static function getColorsAll() {
        return self::where('enabled', 1)
                    ->get();
    }

    public static function removeColor($id): bool {
        return self::where('id', $id)->update(['enabled' => 0]);
    }
}
