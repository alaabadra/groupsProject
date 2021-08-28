<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blockedmember extends Model
{
    public $table="membersblocks";
    public function user(){
        return $this->belongsTo("App\User");
    }
}
