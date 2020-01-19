<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function booking()
    {
        return $this->hasOne('App\Model\Booking', 'room_id','id');
    }
}
