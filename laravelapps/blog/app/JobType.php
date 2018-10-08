<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    protected $table = "jobtype";

    public function stylists()
    {
        return $this->belongsToMany('App\Stylist','stylistjobtype');
    }
}
