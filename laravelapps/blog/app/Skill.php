<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{ 
    protected $table = "skill";

    public function stylists()
    {
        return $this->belongsToMany('App\Stylist','stylistskill');
    }
}
