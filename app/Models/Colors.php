<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    protected $table = 'colors';
    protected $fillable = ['name', 'hex', 'enabled'];

    /**
     * Summary of getColorsAll
     * @return \Illuminate\Database\Eloquent\Collection<int, Colors>
     */
    public static function getColorsAll() {
        return self::where('enabled', 1)
                    ->get();
    }

    /**
     * Summary of addColor
     * @param mixed $data
     * @return Colors
     */
    public static function addColor(mixed $data): Colors {
        return self::create([
            'name' => $data['name'],
            'hex' => $data['hex'],
            'enabled' => 1
        ]);
    }

    /**
     * Summary of removeColor
     * @param mixed $id
     * @return bool
     */
    public static function removeColor(mixed $id): bool {
        return self::where('id', $id)->update(['enabled' => 0]);
    }

    /**
     * Summary of editColor
     * @param mixed $data
     * @return bool
     */
    public static function editColor(mixed $data):bool {
        $id = $data['id'];
        unset($data['id']);
        
        return self::where('id', $id)
        ->update($data);
    }
}
