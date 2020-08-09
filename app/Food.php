<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = [
        'name', 'unitprice', 'image'
    ];

    public function orders()
    {
        return $this->belongsToMany('App\Order')
                    ->withPivot('qty')
                    ->withTimestamps();
    }
}
