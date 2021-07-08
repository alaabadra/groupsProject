<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function comments(){
        return $this->hasMany("App\Comment");
    }

    public function archiveposts(){
        return $this->hasMany("App\Archivepost");
    }
    public function reports(){
        return $this->hasMany("App\Report");
    }
    public function notifications(){
        return $this->hasMany("App\Notification");
    }
    public function forbiddenwordsPost(){
        return $this->belongsToMany("App\Models\Forbiddenword",'forbiddenwords_posts', 'post_id', 'forbiddenword_id');
    }
    public function offensivewordsPost(){
        return $this->belongsToMany("App\Models\Offensiveword",'offensivewords_posts', 'post_id', 'offensiveword_id');
    }
}
