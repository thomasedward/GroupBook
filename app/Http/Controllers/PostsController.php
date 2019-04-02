<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class PostsController extends Controller
{
    public function index()
    {
      $posts = DB::table('posts')->leftJoin('users', 'posts.user_id', '=', 'users.id')->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')->get();
      return view('welcome' , compact('posts'));
    }

    public function addPost(Request $request){
   $content = $request->content;
   $createPost = DB::table('posts')
   ->insert(['content' =>$content, 'user_id' => Auth::user()->id,
    'status' =>1, 'created_at' =>\Carbon\Carbon::now()->toDateTimeString(), 'updated_at' => \Carbon\Carbon::now()->toDateTimeString() ]);

if ($createPost) {
  $posts = DB::table('users')
  ->leftJoin('posts', 'posts.user_id', '=', 'users.id')
  ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
  ->get();
return $posts;
}

  // if($createPost){
  //   return post::with('user','likes','comments')
  //   ->orderBy('created_at','DESC')->get();
  // }
 }
}
