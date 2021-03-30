<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teman extends Model
{
  protected $table = 'temans';
  protected $fillable = [ 'name',	'umur','username', 'picture', 'address', 	'location', 'open',	'close','price','email' ,'roles','token','status','password'];

 /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
 protected $hidden = [
     'password', 'remember_token',
 ];

 /**
  * The attributes that should be cast to native types.
  *
  * @var array
  */
 protected $casts = [
     'email_verified_at' => 'datetime',
 ];
    public function bookings(){
        return $this->hasMany("App\Booking");
      }
    
      public function schedules(){
        return $this->hasMany("App\Schedule");
      }
}
