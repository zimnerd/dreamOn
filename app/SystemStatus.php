<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemStatus extends Model
{
    public $table = "system_status";
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dreamcategory()
    {
        return $this->belongsTo('App\DreamCategory');
    }

    public function quote()
    {
        return $this->belongsTo('App\Quote');
    }

    public function dream()
    {
        return $this->belongsTo('App\Dream');
    }

    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }
}
