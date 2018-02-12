<?php $BASE_PATH = Config::get('otherconstants'); ?>

@if(\Sentry::check())
<nav id="topnav" class="wrapper">
	<div class="nav-content">
		<ul>	
			<li class="logo"><a href="/"></a></li>

	<li class="right"><a href="#" class="submenu"><span class="vcenter"><span class="valign">{{Sentry::getUser()->username}}</span></span></a>
			<span class="submenu-item">
					 <a href="{{ route('auth_logout') }}" title="Log out">Log out</a>
				</span>
			
			</li>
				<li class="right"><a href="{{ route('profile_followback_profile') }}"><span class="vcenter"><span class="valign">Settings</span></span></a></li>
			<li><a href="/socialtasks"><span class="vcenter"><span class="valign">Tasks</span></span></a></li>
		
			
			
		
			{{-- <li class="right"><a href="#" class="nav-profile"><span class="vcenter"><span class="profile-avatar" style="background: url(@if(Sentry::getUser()->avatar) '{{Sentry::getUser()->avatar}}'   @else '/assets/images/homepage/default-user.png' @endif) center no-repeat; border-radius: 200px; width: 55px; height: 55px; float: right; background-size: cover;"></span></span></a></li> --}}
		
			<li class="right"><a href="#" class="RunSearch"><span class="vcenter"><span class="valign"><ins class="fa fa-search"></ins></span></span></a></li>
			<li><a href="/#tags"  class="internal"><span class="vcenter"><span class="valign" style="line-height: 65px; font-family: Arial; font-weight: 900; font-size: 21px;">#</span></span></a></li>
		</ul>	
	</div>
</nav>
@else
<nav id="topnav" class="wrapper">
	<div class="nav-content">
		<ul>	
			<li class="logo"><a href="/"></a></li>
			<li class="right"><a href="/#" data-toggle="modal" data-backdrop="true" data-target="#LoginModal"><span class="vcenter"><span class="valign">Log&nbsp;in</span></span></a></li>			
			<li class="right"><a href="/#" data-toggle="modal" data-backdrop="true" data-target="#SignUpModal"><span class="vcenter"><span class="valign">Sign&nbsp;up</span></span></a></li>
						<li><a href="/#how_it_works"  class="internal"><span class="vcenter"><span class="valign">Help</span></span></a></li>

			<li class="right"><a href="#" class="RunSearch"><span class="vcenter"><span class="valign"><ins class="fa fa-search"></ins></span></span></a></li>
			<li><a href="/#tags"  class="internal"><span class="vcenter"><span class="valign" style="line-height: 65px; font-family: Arial; font-weight: 900; font-size: 21px;">#</span></span></a></li>
			{{-- <li><a href="/about"><span class="vcenter"><span class="valign">About</span></span></a></li> --}}
		</ul>	
	</div>
</nav>
@endif 
<nav class="navbar navbar-inverse navbar-fixed-bottom">
  <div class="container">

    <div class="hidden-sm hidden-xs" id="navbar">
      <ul class="nav navbar-nav">
        <li id="menu_home"><a href="/"></a></li>
      
        @if(\Sentry::check())
          <li><a style="color: #f2ec3f" href="/socialtasks" title="Social Media Tasks">Tasks</a>
          </li>
          
           <li>
         	 <a class="internal" style="color: #27ecf8" href="/#tags" title="Tags">Tags</a>
       	 </li>
        @else
          <li class="active">
          <a class="internal" style="color: #2dff41" href="/#how_it_works" title="How it Works">How it works</a>
        		</li>
          <li><a style="color: #fc00ef" href="/about" title="About">About</a>
          </li>
        @endif
        
        
        <li id="menu_search"><a href="#" class="RunSearch" title="Search">&nbsp;</a></li>
        @if(!\Sentry::check())
        <li>
          <a class="internal" style="color: #27ecf8" href="/#tags" title="Tags">Tags</a>
        </li>
         @endif
        <li>
          @if(!\Sentry::check())
            <a style="color: #fc0306" data-toggle="modal" data-backdrop="true" data-target="#LoginModal" title="Log in" href="#">Log in</a>
          @else
            <a style="color: #2dff41" href="{{ route('profile_followback_profile') }}" title="Settings">Settings</a>
          @endif
        </li>
        @if(\Sentry::check())
          <li>
            <a style="color: #fc0306" href="{{ route('auth_logout') }}" title="Log out">Log out</a>
          </li>
        @else
          <li>
            <a style="color: #f2f126" data-toggle="modal" data-backdrop="true" data-target="#SignUpModal" href="#" title="Sign up">Sign up</a>
          </li>
        @endif
        
      </ul>
    </div>

    <div class="hidden-md hidden-lg" id="navbar-mobile">
      <?php if (Sentry::check()) { ?>

      <ul class="nav navbar-nav">
        <li id="mobile_menu_icon_3"><a href="/socialtasks"></a></li>
        <li id="mobile_menu_icon_1"><a class="internal" href="/#tags"></a></li>
        <li id="mobile_menu_search"><a href="#"></a></li>
        <li id="mobile_menu_icon_4"><a href="{{ route('profile_followback_profile') }}"></a></li>
        <li id="mobile_menu_icon_2"><a href="{{ route('auth_logout') }}"></a></li>
      </ul>

      <?php } else { ?>

      <ul class="nav navbar-nav unauth_mob">
        <li id="unauth_mobile_menu_icon_1">
          <a style="color: #fc6020" href="#" data-toggle="modal" data-backdrop="true" data-target="#LoginModal">Log in</a>
        </li>
        <li id="mobile_menu_search"><a href="#"></a></li>
        <li id="unauth_mobile_menu_icon_2">
          <a style="color: #f2ec3f" href="#" data-toggle="modal" data-backdrop="true" data-target="#SignUpModal">Sign up</a>
        </li>
      </ul>

      <?php } ?>
    </div>

  </div>
</nav>

@if(!\Sentry::check())
  @include('layouts.partials.modals.login')
  @include('layouts.partials.modals.signup')
@endif