<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function customer()
    {
        return $this->hasMany('App\Model\Customer','role_id','id');
    }
}
