<?php

namespace App\Models;

use App\Http\Controllers\CarController;
use App\Http\Controllers\GalleryController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $fillable = ['car_id', 'img'];
    
    /**
     * Summary of getImages
     * @param mixed $id
     * @return Collection<int, Gallery>
     */
    public static function getImages(mixed $id): Collection {
        return self::select('img')
            ->where('gallery.car_id', $id)
            ->get();
    }

    /**
     * Summary of addImage
     * @param int $carId
     * @param string $imagePath
     * @return void
     */
    public static function addImage($carId, string $imagePath): void
    {
        self::create([
            'car_id' => $carId,
            'img' => $imagePath,
        ]);
    }

    /**
     * Summary of car
     * @return BelongsTo<Cars, Gallery>
     */
    public function car():BelongsTo
    {
        return $this->belongsTo(Cars::class, 'car_id');
    }

    /**
     * Summary of getImg
     * @param mixed $name
     * @return Gallery|null
     */
    public static function getImg(string $request):Gallery|null{
        return self::where('img', $request)
                    ->first();
    }

    /**
     * Summary of updateImage
     * @param mixed $verificatedImg
     * @param mixed $imageName
     * @return mixed
     */
    public static function updateImage($verificatedImg, GalleryController $request):mixed {
        $verificatedImg->img = $$request->img;
        return $verificatedImg->save();
    }
    
    /**
     * Summary of deleteImg
     * @param mixed $imageName
     * @return bool|null
     */
    public static function deleteImg(mixed $imageName):bool|null{
        return self::where('img', '=', $imageName)
                    ->delete();
    }
    
}
