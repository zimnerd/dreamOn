<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $fillable = array('full_name', 'instagram', 'facebook', 'twitter', 'whatsapp', 'hobbies', 'bio', 'interests', 'profile_photo_path', 'cover_photo_path');

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

