<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name', 'unitcharge'
    ];

    public function rooms()
    {
    	return $this->belongsToMany('App\Room')
									->withPivot('totalcharges', 'totalqty')
									->withTimestamps();
    }
}
