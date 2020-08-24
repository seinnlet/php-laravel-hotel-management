<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'profilepicture', 'phone', 'address', 'user_id'
    ];

    // one to many relationship
    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
    public function guests()
    {
        return $this->hasMany('App\Guest');
    }

    // one to one relationship
    public function user()
    {
    		return $this->belongsTo('App\User');
    }

}
