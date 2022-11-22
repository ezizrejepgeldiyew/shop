<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class product extends Model
{
    use HasFactory;

    protected $fillable = ['photo', 'photos', 'category_id', 'discount', 'ourbrand_id', 'name', 'price', 'description',  'rating', 'show'];

    public function category()
    {
        return $this->belongsTo(category::class, 'category_id', 'id');
    }

    public function ourbrand()
    {
        return $this->belongsTo(ourbrand::class, 'ourbrand_id', 'id');
    }

    public function discount()
    {
        return $this->hasMany(Discount::class);
    }

    public static function uploadPhotos($request, $photos = null)
    {
        if (!empty($request)) {
            if ($photos) {
                Storage::delete($photos);
            }

            $date = date('Y-m-d');
            foreach ($request as $item) {
                $photos[] = $item->store("phone_photo/multiple/{$date}");
            }
            return json_encode($photos);
        }
        return null;
    }

    public function order()
    {
        return $this->hasMany(Orders::class);
    }

    public static function money_cours($request)
    {
        dd($request);
    }


    public function getPriceAttribute($value)
    {
    }
}
