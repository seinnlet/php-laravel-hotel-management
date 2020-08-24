<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foodcategory extends Model
{
    protected $fillable = [
        'name'
    ];

    // one to many relationship
    public function food()
    {
        return $this->hasMany('App\Food');
    }
}
