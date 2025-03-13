<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $fillable = [
        'user_id', // Add this line
        'car_id',
        'pickup_location_id',
        'dropoff_location_id',
        'start_date',
        'end_date',
        'total_days',
        'total_price',
        'status',
    ];
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function pickupLocation()
    {
        return $this->belongsTo(Location::class, 'pickup_location_id');
    }

    public function dropoffLocation()
    {
        return $this->belongsTo(Location::class, 'dropoff_location_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

}
