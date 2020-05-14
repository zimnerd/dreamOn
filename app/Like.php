<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }//

    public function dream()
    {
        return $this->belongsTo('App\Dream');
    }

    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }
}
