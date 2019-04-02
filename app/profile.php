<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user_id', 'city', 'country', 'about'
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}