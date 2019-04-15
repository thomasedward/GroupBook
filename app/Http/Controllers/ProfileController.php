<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\friendship;
use App\notification;

class ProfileController extends Controller
{
    function index($slug)
    {
      $userDate = DB::table('users')
                  ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
                  ->where('slug',$slug)
                  ->get();
        return view('profile.index',compact('userDate'))->with('data', Auth::user()->profile);
    }

// part of edit profile
    // for update image
    public function updatePhoto(Request $request)
    {
       $file = $request->file('pic');
       
       /* $fileName = $file->getClientOriginalName(); */
       $sha1 = sha1($file->getClientOriginalName());
       $extension = $file->getClientOriginalExtension();
       $fileName = "GroubBook-" . date('Y-m-d-h-i-s')."-".$sha1.".".$extension;
       $path = base_path() . '/public/user_images';
       $file->move($path , $fileName);
        DB::table('users')->where('id', Auth::user()->id)->update(['pic' => $fileName]);

       return back();
    }
    public function editprofile()
    {
      return view('profile.editprofile')->with('data', Auth::user()->profile);
    }
    // for update image
    public function UpdateProfile(Request $request)
    {
      // dd($request->all());
      DB::table('profiles')->where('user_id', Auth::user()->id)->update($request->except('_token','user_id'));

     return back();
    }
    // part of edit profile
// part of edit friendships
    public function FindFriends()
    {
      $uid = Auth::user()->id;
      $allusers = DB::table('users')->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')->where('users.id' ,'!=',$uid)->get();


        return view('profile.Findfriends',compact('allusers'));
    }
    public function addFriend($user_id)
    {

       return Auth::user()->addFriend($user_id);
    }
    public function deleteRequest($user_id)
    {

       return Auth::user()->deleteRequest($user_id);
    }
    public function requests()
    {

      $uid = Auth::user()->id;
      $friendrequest = DB::table('friendships')->where('status', '0')->leftJoin('users', 'friendships.requester', '=', 'users.id')->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')->where('friendships.user_requested' ,'=',$uid)->get();
// dd($friendrequest);

       return view('profile.requests',compact('friendrequest'));
    }
    public function AcceptRequest($name,$user_id)
    {
      $uid = Auth::user()->id;
      $checkiffound = friendship::where('requester', $user_id )->where('user_requested', $uid)->first();
      if($checkiffound)
      {
        DB::table('friendships')->where('requester', $user_id )->where('user_requested', $uid)->update(['status' => '1']);
        $notification = new notification;
        $notification->note	= 'Accepted your friend request' ;
        $notification->user_logged	= $user_id ;
        $notification->user_hero	=  $uid;
        $notification->save();
        return back()->with('success', 'Done ! have new Friend ' . $name  );
      }
      else {
        return back()->with('error', 'Error ! have new Friend');
      }
      dd($checkiffound);

       // return Auth::user()->AcceptRequest($user_id);
    }
    public function PendRequest($user_id)
    {
    $check =  DB::table('friendships')->where('requester' ,'=',$user_id)
      ->where('user_requested' ,'=', Auth::user()->id )->first();



      if ($check) {
        DB::table('friendships')->where('requester' ,'=',$user_id)
          ->where('user_requested' ,'=', Auth::user()->id )->delete();
          return back()->with('success', 'Done ! Pend Friend');
      }
      else {
        return back()->with('error', 'Error ! Pend Friend');
      }
    }
    public function Unfriend($user_id)
    {
    $check =  DB::table('friendships')->where('requester' ,'=',$user_id)
      ->where('user_requested' ,'=', Auth::user()->id )->first();



      if ($check) {
        DB::table('friendships')->where('requester' ,'=',$user_id)
          ->where('user_requested' ,'=', Auth::user()->id )->delete();
          return back()->with('success', 'Done ! Un Friend');
      }
      else {
        return back()->with('error', 'Error ! Un Friend');
      }
    }

    public function Friends()
    {

      $uid = Auth::user()->id;
      $friend1 = DB::table('friendships')->where('status', '1')->leftJoin('users', 'friendships.requester', '=', 'users.id')->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')->where('friendships.user_requested' ,'=',$uid)->get();
      $friend2 = DB::table('friendships')->where('status', '1')->leftJoin('users', 'friendships.user_requested', '=', 'users.id')->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')->where('friendships.requester' ,'=',$uid)->get();
// dd($friendrequest);

       return view('profile.Friends',compact('friend1','friend2'));
    }


// part of edit friendships

// Notifications
public function Notifications($note_id)
{
    // $check = DB::table('notifications')->where('id' ,'=', $note_id )->where('user_logged' ,'=', Auth::user()->id );
    $nots = DB::table('users')
            ->rightJoin('notifications', 'notifications.user_logged', '=', 'users.id')
            ->where('notifications.user_hero' ,'=', Auth::user()->id )
            ->where('notifications.status' ,'=', '0' )
            ->where('notifications.id' ,'=', $note_id  )
            ->orderBy('notifications.id' , 'desc')
            ->get();


            $updateNots = DB::table('users')
            ->rightJoin('notifications', 'notifications.user_logged', '=', 'users.id')
            ->where('notifications.id' ,'=', $note_id )
            ->where('notifications.user_hero' ,'=', Auth::user()->id )
            ->update(['notifications.status' => '1']);

            return view('profile.notifications',compact('nots'));
    // if($check)
    // {
    //   $nots = DB::table('notifications')->where('id' ,'=', $note_id )->where('user_logged' ,'=', Auth::user()->id )->update(['status' => '1']);
    //   return back();
    // }
    // else {
    //   return back();
    // }




}


public function sendMessage(Request $request)
{
//   $conID = $request->conID;
//  $msg = $request->msg;
//  $fetch_userTo = DB::table('messages')
//  ->where('user_to','!=',Auth::user()->id)
//  ->where('conversation_id','==',$conID)
// ->get();
//   return $fetch_userTo[0]->user_to;
$conID = $request->conID;
$msg = $request->msg;
$checkUserId = DB::table('messages')->where('conversation_id', $conID)->get();
if($checkUserId[0]->user_from== Auth::user()->id){
  // fetch user_to
  $fetch_userTo = DB::table('messages')->where('conversation_id', $conID)
  ->get();
    $userTo = $fetch_userTo[0]->user_to;
}else{
// fetch user_to
$fetch_userTo = DB::table('messages')->where('conversation_id', $conID)
->get();
  $userTo = $fetch_userTo[0]->user_to;
}
  // now send message
  $sendM = DB::table('messages')->insert([
    'user_to' => $userTo,
    'user_from' => Auth::user()->id,
    'msg' => $msg,
    'status' => 1,
    'conversation_id' => $conID
  ]);
  if($sendM){
    $userMsg = DB::table('messages')
    ->join('users', 'users.id','messages.user_from')
    ->where('messages.conversation_id', $conID)->orderBy('messages.id')->get();
      $update_status = DB::table('conversations')->where('con_id',$conID)
          ->update([
              'con_status' => 0 // now read by user
          ]);
    return $userMsg;
  }
    // code...
}

public function newMessage(){
  $uid = Auth::user()->id;

  $friends1 = DB::table('friendships')
          ->leftJoin('users', 'users.id', 'friendships.user_requested') // who is not loggedin but send request to
          ->where('friendships.status', 1)
          ->where('requester', $uid) // who is loggedin
          ->get();

  $friends2 = DB::table('friendships')
          ->leftJoin('users', 'users.id', 'friendships.requester')
          ->where('status', 1)
          ->where('user_requested', $uid)
          ->get();

  $friends = array_merge($friends1->toArray(), $friends2->toArray());
  //dd($friends);
  return view('messages.newMessage', compact('friends', $friends));
}

public function sendNewMessage(Request $request){
    $msg = $request->msg;
    $friend_id = $request->friend_id;
    $myID = Auth::user()->id;

    //check if conversation already started or not
    $checkCon1 = DB::table('conversation')->where('user_one',$myID)
    ->where('user_two',$friend_id)->get(); // if loggedin user started conversation

    $checkCon2 = DB::table('conversation')->where('user_two',$myID)
    ->where('user_one',$friend_id)->get(); // if loggedin recviced message first

    $allCons = array_merge($checkCon1->toArray(),$checkCon2->toArray());

    if(count($allCons)!=0){
      // old conversation
      $conID_old = $allCons[0]->id;
      //insert data into messages table
      $MsgSent = DB::table('messages')->insert([
        'user_from' => $myID,
        'user_to' => $friend_id,
        'msg' => $msg,
        'conversation_id' =>  $conID_old,
        'status' => 1
      ]);
    }else {
      // new conversation
      $conID_new = DB::table('conversation')->insertGetId([
        'user_one' => $myID,
        'user_two' => $friend_id
      ]);
      echo $conID_new;

      $MsgSent = DB::table('messages')->insert([
        'user_from' => $myID,
        'user_to' => $friend_id,
        'msg' => $msg,
        'conversation_id' =>  $conID_new,
        'status' => 1
      ]);

    }
}

public function jobs(){
  $jobs = DB::table('users')
  ->Join('jobs','users.id','jobs.company_id')
  ->get();
  return view('profile.jobs', compact('jobs'));
}

public function job($id){
  $jobs = DB::table('users')
  ->leftJoin('jobs','users.id','jobs.company_id')
  ->where('jobs.id',$id)
  ->get();
  return view('profile.job', compact('jobs'));
}

// Notifications
}
