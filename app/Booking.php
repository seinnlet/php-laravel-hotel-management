<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{   
    protected $fillable = [
        'bookingid',
        'bookdate',
        'checkindatetime', 
        'checkoutdatetime', 
        'duration',
        'bookingtype', 
        'noofadult', 
        'noofchildren', 
        'estimatedarrivaltime', 
        'earlycheckin',
        'latecheckout',
        'note', 
        'totalcost', 
        'grandtotal', 
        'pointsused', 
        'status', 
        'guest_id', 
        'staff_id'
    ];

    // many to many relationship
    public function rooms()
    {
        return $this->belongsToMany('App\Room')
                    ->withPivot('note', 'extrabed', 'status')
                    ->withTimestamps();
    }

    // one to one relationship
    public function payment()
    {
        return $this->hasOne('App\Payment');
    }

    // one to many relationships
    public function staff()
    {
        return $this->belongsTo('App\Staff');
    }

    public function guest()
    {
        return $this->belongsTo('App\Guest');
    }
}
