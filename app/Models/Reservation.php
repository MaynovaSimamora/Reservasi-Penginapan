<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id','room_id','check_in','check_out',
        'guest_count','status','total_price','whatsapp_target'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function room() { return $this->belongsTo(Room::class); }
}