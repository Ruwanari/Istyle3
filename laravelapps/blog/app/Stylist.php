<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stylist extends Model

    {
        protected $table = "stylists";
     
        public function skills()
         {
             return $this->belongsToMany('App\Skill','stylistskill');
             
         }
     
         public function jobTypes()
         {
             return $this->belongsToMany('App\JobType','stylistjobtype');
         }
     }

