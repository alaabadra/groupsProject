<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offensiveword extends Model
{
    public function postsoffensiveword(){
        return $this->belongsToMany("App\Models\Post",'offensivewords_posts', 'offensiveword_id', 'post_id');
    }
}
