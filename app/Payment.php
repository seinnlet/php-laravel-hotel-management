<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'booking_id', 'status'
    ];

    // one to one relationship
    public function booking()
    {
        return $this->belongsTo('App\Booking');
    }
}
