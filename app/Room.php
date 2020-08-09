<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'roomno', 'status', 'roomtype_id'
    ];

    // many to many relateionships
    public function bookings()
    {
    	return $this->belongsToMany('App\Booking')
					->withPivot('note', 'extrabed')
					->withTimestamps();
    }

    public function services()
    {
    	return $this->belongsToMany('App\Service')
					->withPivot('totalcharges')
					->withTimestamps();
    }

    // one to many relationships
    public function roomtype()
    {
        return $this->belongsTo('App\Roomtype');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
