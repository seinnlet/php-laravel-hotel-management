<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'profilepicture', 'phone1', 'phone2', 'city', 'country', 'points', 'memberstartdate', 'user_id', 'staff_id', 'membertype_id'
    ];

    // one to one relationship
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // one to many relationship
    public function membertype()
    {
        return $this->belongsTo('App\Membertype');
    }

    public function guest()
    {
        return $this->belongsTo('App\Guest');
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
}
