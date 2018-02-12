<li class="header-search">
	@include('layouts.partials.homepage.search._header_search')
</li>

<li class="<?php if(Request::url() == $BASE_PATH['BASE_ABSOLUTE_URL'].'/received') echo 'active'; ?>">
	<a href="{{ route('bids_for_me') }}">
		@if(isset($totalReceiveCount) && $totalReceieveCount > 0)
			<span class="count" style="font-size:9px;"> {{ $totalReceieveCount }} </span>
		@endif
	<span>Received</span>
	</a>
</li>
<li class="<?php if(Request::url() == $BASE_PATH['BASE_ABSOLUTE_URL'].'/sent') echo 'active'; ?>"><a href=" {{ route('bid_list')}} "><span>Sent</span></a></li>
<li class="<?php if(Request::url() == $BASE_PATH['BASE_ABSOLUTE_URL'].'/settings') echo 'active'; ?>"><a href=" {{ route('profile_followback_profile') }} "><span>Settings</span></a></li>


@if(\Sentry::check())
	<li class="user">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<span>
				<i class="fa fa-user"></i> {{{ (strlen(\Sentry::getUser()->username) > 15) ? substr(\Sentry::getUser()->username,0,15).'...' : \Sentry::getUser()->username }}}
				<i class="fa fa-caret-down"></i>
			</span>
		</a>
		<ul class="dropdown" role="menu">
	    	<li><a href="{{ route('auth_logout') }}">Logout</a></li>
	  	</ul>
	</li>
@endif

    	<!-- <li><a href="{{ route('auth_login') }}">Sign In</a></li>	 -->
