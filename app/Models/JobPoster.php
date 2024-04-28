<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class JobPoster extends Model
{
    public function clients()
    {
        return $this->hasMany('App\Models\Booking');
    }
}

