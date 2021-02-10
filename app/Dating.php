<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dating extends Model
{
    public function user(){
        return $this->belongsTo("App\User");
      }
    
      public function teman(){
        return $this->belongsTo("App\Teman");
      }
    
}
