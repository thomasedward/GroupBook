<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class friendship extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id',  'requester',  'user_requested',  'status'
  ];

}
