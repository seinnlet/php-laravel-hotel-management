<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'room_id', 'totalprice', 'note', 'status'
    ];

    // many to many relationships
    public function food()
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
