<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
  public function teman(){
    return $this->belongsTo("App\Teman");
  }
}
