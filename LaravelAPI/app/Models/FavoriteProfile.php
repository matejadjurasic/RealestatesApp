<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteProfile extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'realestate_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function ($favorite) {
            $favorite->user->increment('favorite');
        });

        /*static::deleted(function ($favorite) {
            $favorite->user->decrement('favorite');
        });*/
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function realestate() {
        return $this->belongsTo(RealEstate::class);
    }
}
