<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    public function status()
    {
        return $this->hasOne('App\SystemStatus');
    }
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
