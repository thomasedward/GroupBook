
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
                      @foreach ($friendrequest as $u)

                      <button type="button" class="list-group-item">
                        <img
                             src="{{ Request::root() }}/user_images/{{ $u->pic }}"
                             width="30px"
                             height="30px"
                             class=" img-thumbnail">
                     <a href="{{ url ('/profile')}}/{{ $u->slug }}">{{$u->name}} </a>     <span class="label label-info">      {{$u->gender}}  </span>




                        <p class="pull-right" style="margin-left:10px;"> <a href="{{ url('/') }}/AcceptRequest/{{ $u->name }}/{{ $u->user_id }}" class="btn btn-info"> Accept Rquest</a>  </p>
                            <p class="pull-right"> <a href="{{ url('/') }}/PendRequest/{{ $u->user_id }}" class="btn btn-danger"> Pend  Rquest</a>  </p>






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
