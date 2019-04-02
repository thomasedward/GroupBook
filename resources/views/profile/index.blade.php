@extends('profile.master')

@section('content')

<div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}">Home</a></li>
            <li><a href="{{ url('/profile') }}/{{ Auth::user()->slug }}">Profile</a></li>
        </ol>
    <div class="row">
      @include('profile.sidebar');
      @foreach($userDate as $uDate )
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{  $uDate->name }}</div>
                <div class="panel-body">


                   <p> Welcome To Your profile </p>
                   <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="thumbnail">
                            <img
                                src="{{ Request::root() }}/user_images/{{  $uDate->pic }}"

                                class=" img-thumbnail">
                            <div class="caption">
                                <h3  align="center">{{  ucwords(  $uDate->name) }}</h3>
                                <p  align="center"> {{ ucwords( $uDate->city ) }}  - {{ ucwords( $uDate->country ) }}</p>
                                @if($uDate->id == Auth::user()->id)
                                <p align="center"><a href="{{ url('editprofile') }}" class="btn btn-primary btn-lg " >  <i class="fa fa-edit"></i>  Edit Profile</a></p>
                                @endif
                            </div>
                            </div>
                        </div>
                         <div class="col-sm-6 col-md-6">
                             <h4> <span class="label label-default">About </span> </h4>
                             <p> {{ $uDate->about }} </p>
                         </div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
