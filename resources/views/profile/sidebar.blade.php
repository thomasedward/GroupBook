
<div class="col-md-3">
  <div class="panel panel-default">
      <div class="panel-heading">SideBar</div>

      <div class="panel-body">
        <ul>
          <li>
            <a href="{{ url('/profile') }}/{{Auth::user()->slug}}"> <img src="{{ Request::root() }}/user_images/{{Auth::user()->pic}}"
            width="32" style="margin:5px"  />
            {{Auth::user()->name}}</a>
          </li>
          <li>
            <a href="{{url('/')}}"> <img src="{{ Request::root() }}/img/news_feed.png"
            width="32" style="margin:5px"  />
            News Feed</a>
          </li>
          <li>
            <a href="{{url('/Friends')}}"> <img src="{{ Request::root() }}/img/friends.png"
            width="32" style="margin:5px"  />
            Friends </a>
          </li>
          <li>
            <a href="{{url('/messages')}}"> <img src="{{ Request::root() }}/img/msg.png"
            width="32" style="margin:5px"  />
           Messages</a>
          </li>
          <li>
            <a href="{{url('/FindFriends')}}"> <img src="{{ Request::root() }}/img/friends.png"
            width="32" style="margin:5px"  />
           Find Friends</a>
          </li>

          <li>
            <a href="{{url('/jobs')}}"> <img src="{{ Request::root() }}/img/jobs.png"
            width="32" style="margin:5px"  />
           Find Jobs</a>
          </li>
        </ul>

      </div>
      </div>
</div>
