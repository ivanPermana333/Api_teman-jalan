<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'teman_id', 'time', 'total_price', 'date'
    ];

    public function user(){
      return $this->belongsTo("App\User");
    }

    public function teman(){
      return $this->belongsTo("App\Teman");
    }
}
