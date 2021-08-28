<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function users(){
        return $this->belongsToMany("App\Models\User",'activities', 'activity_id', 'user_id');
    }
    public function suppervisors(){
        return $this->belongsToMany('App\Models\User', 'activities', 'activity_id', 'suppervisor_id');
    
    }
    public function visitors(){
        return $this->belongsToMany('App\Models\User', 'activities', 'activity_id', 'visitor_id');
    
    }

}
