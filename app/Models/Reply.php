<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public function comment(){//fun to this reply for this comment
        return $this->belongsTo("App\Comment");
    }
    public function reports(){
        return $this->hasMany("App\Report");
    }
}
