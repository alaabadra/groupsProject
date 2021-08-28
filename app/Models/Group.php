<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function usersGroup(){
        return $this->belongsToMany("App\Models\User",'users_groups', 'group_id', 'user_id');
    }
}
