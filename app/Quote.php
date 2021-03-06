<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    //
    protected $fillable = array('quote','author');

    public function status()
    {
        return $this->hasOne('App\SystemStatus');
    }

}
