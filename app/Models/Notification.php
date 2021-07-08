<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function post(){
        return $this->belongsTo("App\Post");
    }
    public function comment(){
        return $this->belongsTo("App\Comment");
    }
    public function user(){
        return $this->belongsTo("App\User");
    }
}
