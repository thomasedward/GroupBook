<?php
/**
 *
 */
 namespace App\Traits ;

 use Illuminate\Support\Facades\DB;
 use Illuminate\Support\Facades\Auth;
use App\friendship;

trait friendable
{
  public function test()
  {
    return 'hi';
  }

  public function addFriend($user_id)
  {


    $friendship = friendship::create([
      'requester' => $this->id , // who login Now
      'user_requested' => $user_id,
    ]);

    if ($friendship) {
    return back();
    }
    else {
      return back();
    }
  }
  public function deleteRequest($user_id)
  {
  $check =  DB::table('friendships')->where('user_requested' ,'=',$user_id)
    ->where('requester' ,'=', Auth::user()->id )->first();



    if ($check) {
      DB::table('friendships')->where('user_requested' ,'=',$user_id)
        ->where('requester' ,'=', Auth::user()->id )->delete();
        return back();
    }
    else {
      return back();
    }
  }




}
