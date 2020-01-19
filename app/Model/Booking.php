<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function room()
    {
        return $this->belongsTo('App\Model\Room','room_id','id');
    }
    public function customer()
    {
        return $this->belongsTo('App\Model\Customer','customer_id','id');
    }
}
