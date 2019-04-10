<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\post;

class PostsController extends Controller
{
    public function index()
    {
      $posts = DB::table('posts')->leftJoin('users', 'posts.user_id', '=', 'users.id')->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')->get();
      return view('welcome' , compact('posts'));
    }

    public function addPost(Request $request , post $post){
   $content = $request->content;
   $createPost = DB::table('posts')
   ->insert(['content' =>$content, 'user_id' => Auth::user()->id,
    'status' =>1, 'created_at' =>\Carbon\Carbon::now()->toDateTimeString(), 'updated_at' => \Carbon\Carbon::now()->toDateTimeString() ]);

if ($createPost) {
//   $posts = DB::table('users')
//   ->leftJoin('posts', 'posts.user_id', '=', 'users.id')
//   ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
//   ->get();
// return $posts;
return $post->with('user')->get();
}

DB::table('friendships')->where('requester' ,'=',$user_id)
  ->where('user_requested' ,'=', Auth::user()->id )->delete();

  // if($createPost){
  //   return post::with('user','likes','comments')
  //   ->orderBy('created_at','DESC')->get();
  // }
 }

 public function deletePost($id , post $post){


$checkPost = DB::table('posts')->where('post_id', $id)->get();

if($checkPost)
{
  DB::table('posts')->where('post_id', $id)
  ->where('user_id' ,'=', Auth::user()->id )->delete();
}

// $posts = DB::table('users')
// ->leftJoin('posts', 'posts.user_id', '=', 'users.id')
// ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
// ->get();
// return $posts;
return $post->with('user','likes')->get();

}

public function likePost($id , post $post){


  $checkifLike = DB::table('likes')->where('post_id', $id)->where('userPost_id', Auth::user()->id)->get();
//dd($checkifLike);
  if (count($checkifLike) == 0) {
    $addLike = DB::table('likes')
    ->insert(['post_id' =>$id, 'userPost_id' => Auth::user()->id,
      'created_at' =>\Carbon\Carbon::now()->toDateTimeString(), 'updated_at' => \Carbon\Carbon::now()->toDateTimeString() ]);
      if ($addLike) {
        return $post->with('user','likes')->get();
      }
  }
  else {
    return $post->with('user','likes')->get();
  }



}

}
