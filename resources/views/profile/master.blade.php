<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GroubBook</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
  @yield('header')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                       GroupBook
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                          @if (Auth::check())
                          <li> <a href="{{ url ('/profile')}}/{{ Auth::user()->slug }}">  Profile  </a> </li>
                          <li> <a href="{{ url ('/FindFriends')}}">  Find Friend  </a> </li>
                       <li> <a href="{{ url ('/requests')}}">   Friends Requests

                            <span class="label label-info">
                       {{App\friendship::where('status','0')->where('user_requested',Auth::user()->id)->count()}}
                      </span>
                     </a> </li>

                       @endif
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else

                        <li> <a href="{{ url ('/messages')}}">   <i class="fa fa-envelope" aria-hidden="true"></i>  </a> </li>
                        <li> <a href="{{ url ('/Friends')}}">   <i class="fa  fa-users"></i>  </a> </li>
                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

                              <i class="fa  fa-bell-o" style="  font-size: 20px;"></i>
                                <span class="label label-info" style="    position: relative;
    top: -15px;
    left: -15px;">
                              {{App\notification::where('status','0')->where('user_hero',Auth::user()->id)->count()}}
                              </span>
                            </a>
                            <?php

                              $nots = DB::table('users')
                                      ->rightJoin('notifications', 'notifications.user_logged', '=', 'users.id')
                                      ->where('notifications.user_hero' ,'=', Auth::user()->id )
                                      //->where('notifications.status' ,'=', '0' )
                                      ->orderBy('notifications.id' , 'desc')
                                      ->get();
// dd($nots);

                             ?>

                            <ul class="dropdown-menu" role="menu" style="width:400px;">
@foreach ($nots as $u2)
                            @if($u2->status == 0)
                              <li  style=" background-color: #ccc;

                                 padding: 5px 10px 0px 10px;">
                            @else
                            <li  style="

                               padding: 5px 10px 0px 10px;">
                            @endif
                                 <a href="{{url('Notifications')}}/{{$u2->id}}">
                                   <div class="row">

                                     <div class="col-md-2">
                                       <img
                                                src="{{ Request::root() }}/user_images/{{ $u2->pic }}"
                                                width="30px"
                                                height="30px"
                                                class=" img-thumbnail">
                                     </div>
                                     <div class="col-md-10">
                                       {{$u2->name}}


                                                 <span class="label label-info">
                                              {{$u2->note}}
                                              </span>
                                              <p>
                                            <i class="fa  fa-users"></i>
                                            {{date("F j, Y, g:i a",strtotime($u2->created_at))}}
                                              </p>
                                     </div>



                                   </div>

</a>

                                </li>
                                @endforeach

                            </ul>
                        </li>


                        <!-- <li><a href="{{ route('register') }}"><i class="fa fa-bell-o"></i>
                          <span class="label label-info">
                        {{App\notification::where('status','0')->where('user_logged',Auth::user()->id)->count()}}
                        </span>
                        </a></li> -->


                            <li class="dropdown">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

                                  <img
                                            src="{{ Request::root() }}/user_images/{{ Auth::user()->pic }}"
                                            width="25px"
                                            height="25px"
                                            class="img-circle"> <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">

                                  <li> <a href="{{ url ('/profile')}}/{{ Auth::user()->slug }}"> <i class="fa fa-user"></i>  Profile  </a> </li>
                                     <li>
                                        <a href="{{ url('editprofile')}}" >
                                <i class="fa fa-edit"></i>            Edit Profile
                                        </a>


                                    </li>

                                    <li> <a href="{{ url ('/FindFriends')}}"><i class="fa fa-search"></i>  Find Friend  </a> </li>
                                 <li> <a href="{{ url ('/requests')}}"><i class="fa fa-envelope-o"></i>   Friends Requests

                                      <span class="label label-info">
                                 {{App\friendship::where('status','0')->where('user_requested',Auth::user()->id)->count()}}
                                </span>
                               </a> </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>        Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/profile.js') }}"></script>
    @yield('footer')

</body>
</html>
