
@extends('profile.master')

@section('content')
<div class="container">
     <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}">Home</a></li>
            <li><a href="{{ url('/profile') }}/{{ Auth::user()->slug }}">Profile</a></li>
            <li><a href="{{ url('/FindFriends') }}">Find Friends</a></li>
            <li><a href="{{ url('/requests') }}"> Friends Requests</a></li>
        </ol>
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  {{session()->get('success')}}
</div>

        @elseif(session()->has('error'))
        <div class="alert alert-success" role="alert">
        {{session()->get('error')}}
      </div>
        @endif
    <div class="row">
      @include('profile.sidebar');

        <div class="col-md-9 ">
            <div class="panel panel-default">
                <div class="panel-heading">{{ Auth::user()->name }}</div>

                <div class="panel-body">


                   <p> Friends Requests </p>
                   <div class="row">

                      <div class="col-sm-6 col-md-12">

                    <h4> <span class="label label-default"> User List :  </span> </h4>
                    <hr>
                    <div class="list-group">
                      <ul   >

                      @foreach ($nots as $u2)
                                                       <li  style="
                                                       border-bottom: 1px solid #000;
                                                       padding: 5px 10px 0px 10px;">
                                                       <a href="{{url('Notifications')}}/{{$u2->id}}">
                                                           <!-- <img
                                                                src="{{ Request::root() }}/user_images/{{ $u2->pic }}"
                                                                width="30px"
                                                                height="30px"
                                                                class=" img-thumbnail"> -->
                                                           
                                                           <a href="{{ url ('/profile')}}/{{ $u2->slug }}">  {{$u2->name}}  </a>
                                                           <p > <span class="label label-info">
                                                         {{$u2->note}}
                                                         </span>  </p>
                      </a>

                                                      </li>
                                                      @endforeach

                                                    </ul>



</div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
