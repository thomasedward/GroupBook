@extends('profile.master')

@section('content')
<div class="container">
     <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}">Home</a></li>
            <li><a href="{{ url('/profile') }}/{{ Auth::user()->slug }}">Profile</a></li>
            <li><a href="{{ url('/editprofile') }}">Edit Profile</a></li>
        </ol>
    <div class="row">
      @include('profile.sidebar');

        <div class="col-md-9 ">
            <div class="panel panel-default">
                <div class="panel-heading">{{ Auth::user()->name }}</div>

                <div class="panel-body">


                   <p> Edit Your profile </p>
                   <div class="row">
                        <div class="col-sm-6 col-md-12">
                    <img
                         src="{{ Request::root() }}/user_images/{{ Auth::user()->pic }}"
                         width="150px"
                         height="150px"
                         class=" img-thumbnail">
                         <br>
                         <br>
                    <a href="{{ url('changeimage') }}" class="btn btn-primary btn-lg " ><i class="fa fa-image"></i> Change Image</a>
                    <br>
                    <br>
                  </div>
                      <div class="col-sm-6 col-md-12">

                    <h4> <span class="label label-default"> Update Your Profile </span> </h4>
                    <hr>
                    <form action="{{url('UpdateProfile')}}" method="post">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!-- <input type="hidden" name="id" value="{{ $data->user_id }}"> -->
                    <div class="col-md-6">



                      <div class="input-group">
                        <span class="input-group-addon" >City Name</span>
                        <input type="text" class="form-control col-md-12" name="city" id="" value="{{ $data->city }}" placeholder="Username" aria-describedby="basic-addon1">
                      </div>
                        <br>
                      <div class="input-group">
                        <span class="input-group-addon" >Country Name</span>
                        <input type="text" class="form-control col-md-12" name="country" id="" value="{{ $data->country }}" id="" value="{{ $data->city }}" placeholder="Username" aria-describedby="basic-addon1">
                      </div>
                        <br>

                          </div>
                        <div class="col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon" >About</span>
                        <textarea class="form-control" name="about" rows="4">{{ $data->about }}</textarea>
                      </div>
                        <br>
                        </div>
                        <br>
                        <div class="input-group">
                          <input type="submit" class="btn btn-success " >
                        </div>

                      </form>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
