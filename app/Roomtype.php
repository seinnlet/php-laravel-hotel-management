<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roomtype extends Model
{
    protected $fillable = [
        'name', 'pricepernight', 'description', 'noofpeople', 'noofbed', 'image1', 'image2', 'image3', 'slug'
    ];

    public function rooms()
    {
        return $this->hasMany('App\Room');
    }
}
