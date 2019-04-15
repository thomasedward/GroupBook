<?php

use App\post;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */



Route::get('/test', function () {

    return App\User::isRole() ;

});


// Route::get('/try', function () {
//     return App\post::with('user','likes','comments)->get();
// });


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile/{slug}', 'ProfileController@index');
    Route::get('/changeimage', function () {
        return view('profile.pic');
    });
    Route::post('/updatePhoto', 'ProfileController@updatePhoto');
    Route::get('/editprofile','ProfileController@editprofile' );
    Route::post('/UpdateProfile','ProfileController@UpdateProfile' );
    Route::get('/FindFriends', 'ProfileController@FindFriends');
    Route::get('/addFriend/{user_id}', 'ProfileController@addFriend');
    Route::get('/deleteRequest/{user_id}', 'ProfileController@deleteRequest');
    Route::get('/requests', 'ProfileController@requests');
    Route::get('/AcceptRequest/{name}/{user_id}', 'ProfileController@AcceptRequest');
    Route::get('/PendRequest/{user_id}', 'ProfileController@PendRequest');
    Route::get('/Unfriend/{user_id}', 'ProfileController@Unfriend');
    Route::get('/Friends', 'ProfileController@Friends');
    Route::get('/Notifications/{note_id}', 'ProfileController@Notifications');

    // messages

    Route::get('/messages', function () {
      return view('messages.messageshow');
    });
    Route::get('/getMessages', function(){
      $AllUsers1 = DB::table('conversations')
      ->join('users','users.id','conversations.user_one')
      ->where('conversations.user_two', Auth::user()->id)->get();

    $AllUsers2 = DB::table('conversations')
    ->join('users','users.id','conversations.user_two')
    ->where('conversations.user_one', Auth::user()->id)->get();
    return array_merge($AllUsers1->toArray(),$AllUsers2->toArray()) ;
    });
    Route::get('/getMessages/{id}', function($id){

        //update cov status
        $update_status = DB::table('conversations')->where('con_id',$id)
            ->update([
                'con_status' => 1 // now read by user
            ]);

        $userMsg = DB::table('messages')
            ->join('users', 'users.id','messages.user_from')
            ->where('messages.conversation_id', $id)->get();
        return $userMsg;

//    $CheckConOne = DB::table('conversations')
//                    ->where('user_one', '=', Auth::user()->id)
//                    ->where('user_two', '=', $id)
//                    ->get();
//    $CheckConTwo = DB::table('conversations')
//                                    ->where('user_one', '=', $id)
//                                    ->where('user_two', '=',Auth::user()->id )
//                                    ->get();
//    if((count($CheckConOne) != 0) || (count($CheckConTwo) != 0))
//    {
//      // fetch message
//    //echo $CheckCon[0]->id;
//    if((count($CheckConOne) != 0))
//    {
//      $userMsgs = DB::table('messages')
//                      ->join('users','users.id','messages.user_from')
//                      ->where('messages.conversation_id', '=', $CheckConOne[0]->id)
//                      ->orderBy('messages.id')->get();
//      return $userMsgs;
//
//    }
//    elseif((count($CheckConTwo) != 0))
//    {
//      $userMsgs = DB::table('messages')
//      ->join('users','users.id','messages.user_from')
//      ->where('messages.conversation_id', '=', $CheckConTwo[0]->id)
//      ->orderBy('messages.id')->get();
//      return $userMsgs;
//
//    }
//    }
//    else {
//      echo "No Messages";
//    }
    });
    Route::post('/sendMessage', 'ProfileController@sendMessage');
    Route::get('/newMessage','ProfileController@newMessage');
    Route::post('/sendNewMessage',  function (Request $request) {
      $msg = $request->msg;
       $friend_id = $request->friend_id;
       $myID = Auth::user()->id;
       //check if conversation already started or not
       $checkCon1 = DB::table('conversations')->where('user_one',$myID)
       ->where('user_two',$friend_id)->get(); // if loggedin user started conversation

       $checkCon2 = DB::table('conversations')->where('user_two',$myID)
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
         $conID_new = DB::table('conversations')->insertGetId([
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
    });

    // fetch All user
    Route::get('/Allusers', function(){

       // dd('here');
     $Allusers =   DB::table('users')
            ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
            ->get();
     return $Allusers;
    });

    // posts
    Route::get('/', 'PostsController@index');

    Route::get('/posts', function(){
    //   $posts = DB::table('posts')
    //   ->rightJoin('users', 'posts.user_id', '=', 'users.id')
    //   ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
    //
    //   ->get();
    //
    // return $posts;

    return App\post::with('user','likes','comments')->get();
    });


    Route::get('/post/{id}', function($id){

        $post =  App\post::where('post_id',$id)->get();
        return $post[0]->content;

    });
    Route::get('/', function(){
    $posts =  App\post::all();
      return view('welcome',compact('posts'));
    });
    Route::post('addPost', 'PostsController@addPost');
    Route::get('deletePost/{id}', 'PostsController@deletePost');
    Route::post('updatePost', 'PostsController@updatePost');

   // upload Image
    Route::post('/uploadImg', 'PostsController@uploadImg');



   //More options  like
   Route::get('likePost/{id}', 'PostsController@likePost');
   Route::get('/likes', function(){
   return App\Like::all();
   });
   Route::get('/', function(){
   $likes =  App\Like::all();
     return view('welcome',compact('likes'));
   });

    //More options  comment
    Route::post('addComment', 'PostsController@addComment');
    //  jobs
    //jobs for users
      Route::get('jobs', 'ProfileController@jobs');
      Route::get('job/{id}','ProfileController@job');
     //search
    Route::post('search', 'PostsController@search');

});
Route::group(['prefix' => 'company','middleware' => ['auth','company']], function () {
  Route::get('/', 'CompanyController@index');
  Route::get('/addJob', 'CompanyController@addJob');
  Route::get('/jobs', 'CompanyController@jobs');
  Route::post('/addJobSubmit', 'CompanyController@addJobSubmit');


});
Route::group(['prefix' => 'admin','middleware' => ['auth','admin']], function () {
  Route::get('/', 'AdminController@index');
});
