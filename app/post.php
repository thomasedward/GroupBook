<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function likes()
    {
        return $this->hasMany(Like::class,'post_id', 'post_id');
    }

}
