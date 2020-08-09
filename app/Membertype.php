<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membertype extends Model
{
    protected $fillable = [
        'name'
    ];

    // one to many relationship
    public function members()
    {
        return $this->hasMany('App\Member');
    }
}
