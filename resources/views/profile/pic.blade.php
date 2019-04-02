@extends('profile.master')

@section('content')
<div class="container">
      <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}">Home</a></li>
            <li><a href="{{ url('/profile') }}/{{ Auth::user()->slug }}">Profile</a></li>
             <li><a href="{{ url('/editprofile') }}">Edit Profile</a></li>
            <li><a href="{{ url('/changeimage') }}">Edit Image</a></li>
        </ol>
    <div class="row">
      @include('profile.sidebar');
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ Auth::user()->name }}</div>

                <div class="panel-body">
                   <p> Update Your Iamge</p>
                    <img
                         src="{{ Request::root() }}/user_images/{{ Auth::user()->pic }}"
                         width="150px"
                         height="150px"
                         class=" img-circle">
                         <br>
                         <hr>
                         <form action="{{ url('/updatePhoto') }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="file" name="pic" id="" class="form-control">
                            <br>
                            <input type="submit" name="btn"  class="btn btn-success">
                            </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
