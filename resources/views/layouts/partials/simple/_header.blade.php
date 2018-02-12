<a href="{{route('chk_user_socail_account')}}" class="chk-user-social-acc" style="display:none">User Social Acc</a>
<header id="received">
	<nav class="navigation" role="navigation">
		<div class="navcontainer">
			<a href="#" class="mobilenav"><ins class="fa fa-bars"></ins></a>
		@if(Sentry::check())
 		@else
 			<a href="#" class="signup logout-menu-ajax register-form-colorbox cboxElement">Sign Up</a>
 		@endif
 
{{--
			<a class="logo" href="{{ route('index') }}">
				<img src="/assets/images/homepage/logo/logo.png" alt="Followback" style="display: block; opacity: 1;">
			</a>
--}}

	<a class="logo-beta" href="{{ route('index') }}">
			<img src="/assets/images/logo-followback_beta.png" alt="Followback" style="display: block; opacity: 1;">
	</a>
			

			

	<div class="menu">
	<a href="#" class="closenav"><ins class="fa fa-bars"></ins></a>
	    <!-- Include Navigation Bar -->
	   		@include('layouts.partials.simple._header._nav')
	  </div>
	</div>
	</nav>
</header>


