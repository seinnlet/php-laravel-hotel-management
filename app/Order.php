<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'room_id', 'totalprice'
    ];

    // many to many relationships
    public function foods()
    {
    	return $this->belongsToMany('App\Food')
									->withPivot('qty')
									->withTimestamps();
    }

    // one to many relationships
    public function room()
    {
        return $this->belongsTo('App\Room');
    }
}
