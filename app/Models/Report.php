<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function post(){
        return $this->belongsTo("App\Post");
    }
    public function comment(){
        return $this->belongsTo("App\Comment");
    }
    public function reply(){
        return $this->belongsTo("App\Reply");
    }
}
