<?php

namespace App\Models;

use App\Http\Controllers\ColorController;
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
    public static function addColor(ColorController $request): Colors {
        return self::create([
            'name' => $request->name,
            'hex' => $request->hex,
            'enabled' => 1
        ]);
    }

    public static function removeColor(ColorController $request): bool {
        return self::where('id', $request->id)->update(['enabled' => 0]);
    }

    /**
     * Summary of editColor
     * @param mixed $data
     * @return bool
     */
    public static function editColor(ColorController $request):bool {
        $color = self::where('id', $request->id)->first();

        if (!$color) {
            return false;
        }
    
        $updatedData = [];
    
        if ($color->name !== $request->name && !is_null($request->name)) {
            $updatedData['name'] = $request->name;
        }
        
        if ($color->hex !== $request->hex && !is_null($request->hex)) {
            $updatedData['hex'] = $request->hex;
        }
    
        if (empty($updatedData)) {
            return false;
        }
    
        return $color->update($updatedData);
    }
}
