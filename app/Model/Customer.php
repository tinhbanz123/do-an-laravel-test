<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function role()
    {
        return $this->belongsTo('App\Model\Role','role_id','id');
    }
//    public function booking()
//    {
//        return $this->hasOne('App\Model\Booking', 'customer_id','id');
//    }

}
