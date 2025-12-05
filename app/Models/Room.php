<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name','slug','location','type','description',
        'capacity','price_per_night','thumbnail','is_active'
    ];

    public function images() {
        return $this->hasMany(RoomImage::class);
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
}
