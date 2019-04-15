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
return $post->with('user','likes','comments')->get();
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
return $post->with('user','likes','comments')->get();

}


public function updatePost(Request $request , post $post){
        $updatedContent = $request->updatedContent;
        $post_id = $request->post_id;
        $checkifPost = DB::table('posts')->where('post_id', $post_id)->where('user_id', Auth::user()->id)->get();

        if ($checkifPost[0]) {
            $update_status = DB::table('posts')->where('post_id',$post_id)
                ->update([
                    'content' => $updatedContent // now read by user
                ]);
            return $post->with('user','likes','comments')->get();
        }
        else{
            return $post->with('user','likes','comments')->get();
        }
    }
public function likePost($id , post $post){


  $checkifLike = DB::table('likes')->where('post_id', $id)->where('userPost_id', Auth::user()->id)->get();
//dd($checkifLike);
  if (count($checkifLike) == 0) {
    $addLike = DB::table('likes')
    ->insert(['post_id' =>$id, 'userPost_id' => Auth::user()->id,
      'created_at' =>\Carbon\Carbon::now()->toDateTimeString(), 'updated_at' => \Carbon\Carbon::now()->toDateTimeString() ]);
      if ($addLike) {
        return $post->with('user','likes','comments')->get();
      }
  }
  else {
    return $post->with('user','likes','comments')->get();
  }





}

    public function addComment(Request $request , post $post){
      if($request->contentcomment)
      {
          $checkifcomment = DB::table('comments')
              ->where('comment', $request->contentcomment)
              ->where('post_com_id', $request->post_id)
              ->where('user_com_id', Auth::user()->id)->get();
//dd($checkifLike);
          if (count($checkifcomment) == 0) {
              $addcomment = DB::table('comments')
                  ->insert(['comment' =>$request->contentcomment,'post_com_id' =>$request->post_id, 'user_com_id' => Auth::user()->id,
                      'created_at' =>\Carbon\Carbon::now()->toDateTimeString(), 'updated_at' => \Carbon\Carbon::now()->toDateTimeString() ]);
              if ($addcomment) {
                  return $post->with('user','likes','comments')->get();
              }
          }
          else {
              return $post->with('user','likes','comments')->get();
          }

      }
      else
      {
          return $post->with('user','likes','comments')->get();
      }
    }

    // uploadImg
    public function uploadImg(Request $request,  post $post)
    {


        $image = $request->get('imageupload');
        // remove  extra parts
        $exploded = explode(',', $image);
        // extention
        if (str_contains($exploded[0], 'gif')) {
            $extension = 'gif';
        } elseif (str_contains($exploded[0], 'png')) {
            $extension = 'png';
        } else {
            $extension = 'jpg';
        }
        //decode
        $decode = base64_decode($exploded[1]);
        $fileName = "GroupBook-image-post-" . date('Y-m-d-h-i-s') . "-" . str_random() . "." . $extension;
        $path = public_path() . '/posts_images/' . $fileName;
        file_put_contents($path, $decode);
        if (file_put_contents($path, $decode)) {
           // $content = 'done';
            if (($request->content) == '')
            {
                $content = 'done';
            }else{
                $content = $request->content;
            }
            $createPost = DB::table('posts')
                ->insert(['content' => $content, 'user_id' => Auth::user()->id, 'post_image' => $fileName,
                    'status' => 1, 'created_at' => \Carbon\Carbon::now()->toDateTimeString(), 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);

            if ($createPost) {

                return $post->with('user', 'likes', 'comments')->get();
            } else {

                return $post->with('user', 'likes', 'comments')->get();
            }
            //return $decode;

        }
    }

    //search
    public function search(Request $request)
    {
        $qry =  $request->qry;
        return  $users = DB::table('users')->where('name','like','%'.$qry.'%')->get();
    }


}
