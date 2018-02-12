<a href="{{route('chk_user_socail_account')}}" class="chk-user-social-acc" style="display:none">User Social Acc</a>
<header id="received">
	<nav class="navbar navbar-default" role="navigation">
	  <div class="container">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="{{ route('index') }}">
	      	{{ HTML::image('assets/images/homepage/logo/logo.png', $alt="", $attributes = array('id' => 'logo','onmouseover' =>"$('#logo').data('shiningImage').shine();",'onmouseout'=>"$('#logo').data('shiningImage').stopshine();")) }} 
	      </a>
	    </div>

	    <!-- Include Navigation Bar -->
	   		@include('layouts.partials.simple._header._nav')
	  </div><!-- /.container-fluid -->
	</nav>
</header>