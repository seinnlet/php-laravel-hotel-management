<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roomtype extends Model
{
    protected $fillable = [
        'name', 'pricepernight', 'description', 'noofpeople', 'noofbed', 'image'
    ];

    public function rooms()
    {
        return $this->hasMany('App\Room');
    }
}
