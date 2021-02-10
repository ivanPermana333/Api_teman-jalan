<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teman extends Model
{
  protected $table = 'temans';
    public function bookings(){
        return $this->hasMany("App\Booking");
      }
    
      public function schedules(){
        return $this->hasMany("App\Schedule");
      }
}
