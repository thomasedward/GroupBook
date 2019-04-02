
@extends('profile.master')

@section('content')
<div class="container">
     <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}">Home</a></li>
            <li><a href="{{ url('/profile') }}/{{ Auth::user()->slug }}">Profile</a></li>
            <li><a href="{{ url('/FindFriends') }}">Find Friends</a></li>
            <li><a href="{{ url('/requests') }}"> Friends Requests</a></li>
            <li><a href="{{ url('/Friends') }}"> Friends </a></li>
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


                   <p> My  Friends  </p>
                   <div class="row">

                      <div class="col-sm-6 col-md-12">

                    <h4> <span class="label label-default"> Friends List :  </span> </h4>
                    <hr>
                    <div class="list-group">
                      @foreach ($friend1 as $u1)

                      <button type="button" class="list-group-item" >

                        <img
                             src="{{ Request::root() }}/user_images/{{ $u1->pic }}"
                             width="30px"
                             height="30px"
                             class=" img-thumbnail">
                             <a href="{{ url ('/profile')}}/{{ $u1->slug }}">{{$u1->name}} </a>
                     
                           <span class="label label-info">      {{$u1->gender}}  </span>



<p class="pull-right"> <a href="{{ url('/') }}/Unfriend/{{ $u1->user_id }}" class="btn btn-danger"> Unfriend</a>  </p>





                        <div class="caption">
                            <p  > {{ ucwords( $u1->city ) }}  - {{ ucwords( $u1->country ) }}</p>
                        </div>

                      </button>

@endforeach
@foreach ($friend2 as $u2)

<button type="button" class="list-group-item">
  <img
       src="{{ Request::root() }}/user_images/{{ $u2->pic }}"
       width="30px"
       height="30px"
       class=" img-thumbnail">
  {{$u2->name}}     <span class="label label-info">      {{$u2->gender}}  </span>




  <p class="pull-right"> <a href="{{ url('/') }}/Unfriend/{{ $u2->user_id }}" class="btn btn-danger"> Unfriend</a>  </p>





  <div class="caption">
      <p  > {{ ucwords( $u2->city ) }}  - {{ ucwords( $u2->country ) }}</p>
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
