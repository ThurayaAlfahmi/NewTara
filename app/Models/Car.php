<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'car_id');
    }

   
}
