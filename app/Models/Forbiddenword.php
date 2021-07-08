<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forbiddenword extends Model
{
    public function commentsForbiddenword(){
        return $this->belongsToMany("App\Models\Comment",'forbiddenwords_comments', 'forbiddenword_id', 'comment_id');
    }
    public function postsForbiddenword(){
        return $this->belongsToMany("App\Models\Post",'forbiddenwords_posts', 'forbiddenword_id', 'post_id');
    }
    public function repliesForbiddenword(){
        return $this->belongsToMany("App\Models\Reply",'forbiddenwords_replies', 'forbiddenword_id', 'reply_id');
    }
}
