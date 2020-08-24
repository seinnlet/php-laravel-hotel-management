<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membertype extends Model
{
    protected $fillable = [
        'name', 'earnpoints', 'laundrydiscount', 'fooddiscount', 'additionalbenefits', 'numberofstays', 'numberofnights', 'paidamount'
    ];

    // one to many relationship
    public function guests()
    {
        return $this->hasMany('App\Guest');
    }
}
