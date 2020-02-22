<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function booking()
    {
        return $this->hasMany('App\Model\Booking', 'room_id','id');
    }

    public function slide()
    {
        return $this->hasMany('App\Model\Slide', 'room_id','id');
    }
}
