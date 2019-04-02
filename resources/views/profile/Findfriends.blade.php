@extends('profile.master')

@section('content')
<div class="container">
     <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}">Home</a></li>
            <li><a href="{{ url('/profile') }}/{{ Auth::user()->slug }}">Profile</a></li>
            <li><a href="{{ url('/FindFriends') }}">Find Friends</a></li>
        </ol>
    <div class="row">
      @include('profile.sidebar');

        <div class="col-md-9 ">
            <div class="panel panel-default">
                <div class="panel-heading">{{ Auth::user()->name }}
                  <a href="{{ url('/requests') }}"> <span class="label label-default pull-right"> Requests  </span> </a>
                </div>

                <div class="panel-body">


                   <p> Find Friends </p>

                   <div class="row">

                      <div class="col-sm-6 col-md-12">

                    <h4> <span class="label label-default"> User List :  </span> </h4>
                    <hr>
                    <div class="list-group">
                      @foreach ($allusers as $u)

                      <button type="button" class="list-group-item">
                        <img
                             src="{{ Request::root() }}/user_images/{{ $u->pic }}"
                             width="30px"
                             height="30px"
                             class=" img-thumbnail">
                         <a href="{{ url ('/profile')}}/{{ $u->slug }}">{{$u->name}} </a>       <span class="label label-info"> {{$u->gender}} </span>
                        <?php

                          $check = DB::table('friendships')->where('user_requested' ,'=',$u->user_id)
                          ->where('requester' ,'=', Auth::user()->id )->first();

                         ?>
                         @if($check != '')
                         <p class="pull-right"> <a href="{{ url('/') }}/deleteRequest/{{ $u->user_id }}" class="btn btn-success">requested</a>  </p>
                         @else

                            <p class="pull-right"> <a href="{{ url('/') }}/addFriend/{{ $u->user_id }}" class="btn btn-info">Add To Friend</a>  </p>
                      @endif





                        <div class="caption">
                            <p  > {{ ucwords( $u->city ) }}  - {{ ucwords( $u->country ) }}</p>
                        </div>

                      </button>
@endforeach




</div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
