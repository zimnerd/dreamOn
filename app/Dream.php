<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dream extends Model
{
    //

    protected $fillable = array('heading', 'description', 'important_facts','tags', 'user_id');
}
