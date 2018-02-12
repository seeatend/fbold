<?php $BASE_PATH = Config::get('otherconstants');
/*
	<li><a href="{{ route('profile_connect')}}" class="<?php if(Request::url() == $BASE_PATH['BASE_ABSOLUTE_URL'].'/settings') echo 'active'; ?>">Sync Accounts</a></li>
	<li><a href="{{ route('profile_services_prices')}}" class="<?php if(Request::url() == $BASE_PATH['BASE_ABSOLUTE_URL'].'/my-prices') echo 'active'; ?>">My Prices</a></li>
*/
 ?> 
<div class="profile-sidebar">
	<ul> 
		<li><a href="{{ route('profile_followback_profile')}}" class="<?php if(Request::url() == $BASE_PATH['BASE_ABSOLUTE_URL'].'/settings/followback-profile' || Request::url() == $BASE_PATH['BASE_ABSOLUTE_URL']) echo 'active';?>">{{--<span class="icon"><i class="fa fa-user"></i></span>--}} <span class="text"><span class="desktop-only">Followback</span> Profile</span></a></li>
		<li><a href="{{ route('profile_payment')}}" class="<?php if(Request::url() == $BASE_PATH['BASE_ABSOLUTE_URL'].'/settings/receiving-payments') echo 'active';?>">{{--<span class="icon"><i class="fa fa-usd"></i></span>--}} <span class="text"><span class="desktop-only">Receiving</span> Payments</span> </a></li>
		<li><a href="{{route('blocked_users')}}" class="<?php if(Request::url() == $BASE_PATH['BASE_ABSOLUTE_URL'].'/settings/blocked-users') echo 'active';?>">{{--<span class="icon"><i class="fa fa-user-times"></i></span>--}} <span class="text">Block <span class="desktop-only">Users</span></span></a></li>	
	</ul>
</div>