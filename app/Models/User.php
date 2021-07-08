<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    //use LaratrustUserTrait;

    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

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

    public function groupsUser(){
        return $this->belongsToMany("App\Models\Group",'users_groups', 'user_id', 'group_id');
    }
    public function role(){
        return $this->belongsTo("App\Models\Role");
    }
    public function deletemembers(){
        return $this->hasMany("App\Models\Deletemember");
    }
    public function membersblocks(){
        return $this->hasMany("App\Models\membersblock");
    }
    public function messages(){
        return $this->hasMany("App\Models\Message");
    }
    public function archiveposts(){
        return $this->hasMany("App\Archivepost");
    }
    public function notifications(){
        return $this->hasMany("App\Notification");
    }
}
