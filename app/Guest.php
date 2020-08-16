<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'name', 'email', 'phone1', 'phone2', 'city', 'country', 'user_id', 'membertype_id'
    ];

    // one to many relationship
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function membertype()
    {
        return $this->belongsTo('App\Membertype');
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
}
