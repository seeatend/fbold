<nav class="navbar navbar-static-top">
  <div class="navbar-header">
  @if(Sentry::check())
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    @endif
    <label class="title text-center">
      <a href="{{route('profile_dashboard')}}"><img src="{{asset_image('logowhite.png')}}" alt="Logo"></a>
    </label>
    @if(Sentry::check())
    <ul class="navbar-right">
      <li><a href="{{route('bids_for_me')}}" class='nav-icon notifications'><div class="circle rounded">{{$pendingBidsCount}}</div></a></li>
      {{--<li><a href="{{URL::route('service_list')}}" class='nav-icon block'></a></li>
      <li><a href="{{URL::route('bid_list')}}" class='nav-icon user'></a></li>--}}
    </ul>
    @endif
  </div>
  <div class="navbar-collapse collapse">
    <ul class="nav navbar-nav">
      @if(Sentry::check())
      <li><a href="{{route('profile_dashboard')}}">Search</a></li>
      <li><a href="{{route('bids_for_me')}}">Received Bids</a></li>
      <li><a href="{{route('bid_list')}}">Sent Bids</a></li>
      <li><a href="{{route('profile_services_prices')}}">Set My Task Prices</a></li>
      <li><a href="{{route('profile_connect')}}">Connect Other Social Media Accounts</a></li>
      <li><a href="{{route('blocked_users')}}">Block User</a></li>
      <li><a href="{{route('auth_logout')}}">Logout</a></li>
      @endif
    </ul>
  </div>
</nav>