<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function dreams()
    {
        return $this->hasMany('App\Dream');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function reads()
    {
        return $this->hasMany('App\Read');
    }

    public function status()
    {
        return $this->hasOne('App\SystemStatus');
    }

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }
}