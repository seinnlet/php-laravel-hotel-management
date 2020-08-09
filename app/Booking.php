<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'checkindate', 'checkoutdate', 'noofadult', 'noofchildren', 'estimatedarrivaltime', 'totalcost', 'grandtotal', 'status', 'note', 'guest_id', 'user_id'
    ];

    // many to many relationship
    public function rooms()
    {
        return $this->belongsToMany('App\Room')
                    ->withPivot('note', 'extrabed')
                    ->withTimestamps();
    }

    // one to one relationship
    public function payment()
    {
        return $this->hasOne('App\Payment');
    }

    // one to many relationships
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function guest()
    {
        return $this->belongsTo('App\Guest');
    }
}
