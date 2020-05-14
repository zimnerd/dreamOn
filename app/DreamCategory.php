<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DreamCategory extends Model
{
    //
    public function dreams()
    {
        return $this->hasMany('App\Dream');
    }
    public function status()
    {
        return $this->hasOne('App\SystemStatus');
    }
}
