<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model
{
    use HasFactory;

    public function favoriteprofile()
    {
        return $this->hasMany(FavoriteProfile::class);
    }
}
