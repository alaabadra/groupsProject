<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post(){//fun to this comment for this post
        return $this->belongsTo("App\Post");
    }
    public function replies(){
        return $this->hasMany("App\Reply");
    }
    public function reports(){
        return $this->hasMany("App\Report");
    }
    public function notifications(){
        return $this->hasMany("App\Notification");
    }
    public function forbiddenwordsComment(){
        return $this->belongsToMany("App\Models\Forbiddenword",'forbiddenwords_comments', 'comment_id', 'forbiddenword_id');
    }
}
