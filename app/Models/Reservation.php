<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function users(){
        return $this->belongsToMany("App\Models\User",'reservations', 'doctor_id', 'user_id');
    }
    public function doctors(){
        return $this->belongsToMany('App\Models\User', 'reservations', 'user_id', 'doctor_id');
    
    }
}
