<?php

namespace App;
use App\Traits\friendable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;

class User extends Authenticatable
{
  use Notifiable;
  use friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'pic', 'password', 'gender', 'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function isRole()
    {
      return $this->role;
      // code...
    }
    public function profile()
    {
        return $this->hasOne('App\profile');
    }
    public function isOnline()
    {
        return Cache::has('active-' . $this->id);
    }
  

}
