<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dream extends Model
{
    //

    protected $fillable = array('heading', 'dream_date', 'description', 'important_facts', 'tags', 'user_id');

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function dreamcategory()
    {
        return $this->belongsTo('App\DreamCategory');
    }

    public function status()
    {
        return $this->hasOne('App\SystemStatus');
    }

    public function reads()
    {
        return $this->hasMany('App\Read');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
