@extends('profile.master')
@section('header')
<!-- Styles -->
<style>
    html, body {
        background-color: #ddd;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        margin: 0;
    }
    .top_bar{
      position:relative; width:99%; top:0; padding:5px; margin:0 5
    }
    .full-height {
      margin-top:50px
    }
    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }
    .position-ref {
        position: relative;
    }
    .top-right {
        position: absolute;
        right:5px; top:15px
    }
    .top-left {
        position: absolute;
        width:40%

    }
    .content {
        text-align: center;
    }
    .title {
        font-size: 84px;
    }
    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }
    .m-b-md {
        margin-bottom: 30px0;
    }
    .head_har{
      background-color: #f6f7f9;
            border-bottom: 1px solid #dddfe2;
            border-radius: 2px 2px 0 0;
            font-weight: bold;
            padding: 8px 6px;

    }
    .left-sidebar, .right-sidebar{
      background-color:#fff;
      height:600px;

    }
    .posts_div{margin-bottom:10px !important;}
    .posts_div h3{
      margin-top:4px !important;

    }
    #postText{
      border:none;
      height:100px
    }
    .likeBtn{
      color: #4b4f56; font-weight:bold; cursor: pointer;
    }
    .left-sidebar li { padding:10px;
      border-bottom:1px solid #ddd;
    list-style:none; margin-left:-20px}
    .dropdown-menu{min-width:120px; left:-30px}
    .dropdown-menu a{ cursor: pointer;}
    .dropdown-divider {
      height: 1px;
      margin: .5rem 0;
      overflow: hidden;
      background-color: #eceeef;}
      .user_name{font-size:18px;
       font-weight:bold; text-transform:capitalize; margin:3px}
      .all_posts{background-color:#fff; padding:5px;
       margin-bottom:15px; border-radius:5px;
       min-height: 600px;
        -webkit-box-shadow: 0 8px 6px -6px #666;
        -moz-box-shadow: 0 8px 6px -6px #666;
         box-shadow: 0 8px 6px -6px #666;}
        #commentBox{
          background-color:#ddd;
          padding:10px;
          width:99%; margin:0 auto;
          background-color:#F6F7F9;
          padding:10px;
          margin-bottom:10px
        }
        #commentBox li { list-style:none; padding:10px; border-bottom:1px solid #ddd}
        .commet_form{ padding:10px; margin-bottom:10px}
        .commentHand{color:blue}
        .commentHand:hover{cursor:pointer}
        .upload_wrap{
          position:relative;
          display:inline-block;
          width:100%
        }
        .center-con {
        max-height: 600px;
        position: absolute;
        left: calc(25%);
        width: 49%;
        overflow-y: scroll;
    }
        a:hover, a:focus {
    color: #216a94;
    text-decoration: none;
}
        @media (min-width: 268px) and (max-width: 768px) {

          .center-con{
            max-height:600px;
            position: relative;
            left:0px;
            overflow-y: scroll;
          }
        }


</style>
@endsection

@section('content')
<div id="app">
</div>
<!-- <p class="alert alert-success">@{{message}}</p> -->
<div class="col-md-3 left-sidebar hidden-xs hidden-sm" style="position:fixed; left:10px">


  <div class="row" style="padding:10px">
     <div class="col-md-4"> </div>
     <div class="col-md-6">Messenger</div>
     <div class="col-md-2 pull-right">
       <a href="{{url('/newMessage')}}">
         <img src="{{ Request::root() }}/img/compose.png" title="Send New Messages"></a>
     </div>
   </div>


<ul v-for="privsteMsg in privsteMsgs" >

<li v-if="privsteMsg.con_status == 0" @click="messages(privsteMsg.con_id)"
    style="list-style:none; margin-top:10px;
           background-color:#ddd;">
<img :src="'{{ Request::root() }}/user_images/' + privsteMsg.pic"
width="32" style="margin:5px"  /> @{{privsteMsg.name}}
<p> message will dispaly </p>
</li>

    <li v-else @click="messages(privsteMsg.con_id)"
        style="list-style:none; margin-top:10px;
           background-color:#fff;">
        <img :src="'{{ Request::root() }}/user_images/' + privsteMsg.pic"
             width="32" style="margin:5px"  /> @{{privsteMsg.name}}
        <p> message will dispaly </p>
    </li>


</ul>

</div>
<!-- left side end -->
<!-- center content start -->
<div class="col-md-6 col-sm-12 col-xs-12 center-con" style="position:fixed; ">





            <div class="col-md-12 all_posts">

              <h3 style="text-align: center;"> Messages </h3>
              <hr>

              <div v-for="singleMsg in singleMsgs" >

              <div v-if="singleMsg.user_from == <?php echo Auth::user()->id ?>">
                <div class="col-md-12" style="margin-top:10px">
                     <img :src="'{{ Request::root() }}/user_images/' + singleMsg.pic"
                   style="width:30px; height:30px; border-radius:100%; margin-left:5px; margin-top:20px;" class="pull-right">
                   <div style="float:right; background-color:#0099FF; padding:15px; margin:10px;
                   text-align:right;   color:#fff; border-radius:10px; " class="col-md-9">
                          @{{singleMsg.msg}}
                   </div >
                   </div>




              </div>
              <div  v-else>

                <div class="col-md-12 pull-right"  style="margin-top:10px">
                  <img :src="'{{ Request::root() }}/user_images/' + singleMsg.pic"
                style="width:30px; height:30px; border-radius:100%;  margin-left:5px; margin-top:20px;" class="pull-left">
                <div style="float:left; background-color:#f0f0f0; padding:15px; margin:10px;
                text-align:left;   color:#000; border-radius:10px;"  class="col-md-9">
                       @{{singleMsg.msg}}
                </div >

               </div>


              </div>

              </div >

              <hr>
              <input type="hidden"  v-model="conID" name="" value="">
                 <textarea class="col-md-12 form-control" v-model="msgFrom" @keydown="inputHandler"
                  style="margin-top: 15px;
                        margin-bottom: 15px;
                        padding-bottom: 15px;
                        border: none;
                        background-color: #ccc;"></textarea>
              </div>





    </div>
<!-- center content end -->
<div class="col-md-3 right-sidebar hidden-sm hidden-xs" style="position:fixed; right:10px">
    <h3 align="center">Right Sidebar</h3>


</div>
<!-- right side end -->
@endsection
