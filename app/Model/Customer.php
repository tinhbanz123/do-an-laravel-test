<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function bookings()
    {
        return $this->hasOne('App\Model\Booking', 'customer_id','id');
    }
}
