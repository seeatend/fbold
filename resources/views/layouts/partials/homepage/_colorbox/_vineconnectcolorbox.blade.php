<!-- Temp Place Code for Vine Fr Colorbox  (Update in future)-->
<nav>
<div class="vine-connect-login-content">
	
	<div class="loader-contain">
		<div class="search-loader"></div>
	</div>
		
	<div class="row container login-container" style="width:100%">

		<div class="col-md-4" style="padding:30px;width:100%;">
			<div style="text-align:center">
				{{ HTML::image('assets/images/icons/vine-for-login.jpg', $alt="", $attributes = array('height' => '80')) }} 

			</div>
			<p style="text-align:center;margin-bottom:20px;">Please sign into your Vine account.</p>
			<p class="vine-fail-error"></p>
			<!-- <button class="twitter-signin-button" data-ember-action="2361">Sign in with Twitter</button>
				<p style="text-align:center;">or</p> -->
		    {{Form::open([
		    	'route'=>'do_custom_social_vine_login',
		    	'class'=>'vine-login-form-box'
		    	])
		    }}
		    	
					{{Form::field([
						'name' =>'email',
						'placeholder' => 'Email',
						'class' => 'custom-form-input vine-input'
					])}}
					{{Form::field([
						'name' =>'password',
						'placeholder' => 'Password',
						'type' => 'password',
						'class' => 'custom-form-input vine-input'
					])}}
					{{Form::field([
						'name'  => 'loginFor',
						'value' => 'vine',
						'type'  => 'hidden'
					])}}
				<div class="vine-submit-btn-container">
					<a href="{{route('remind_password')}}">Forgot your password?</a>
					<button class="vine-login-submit-btn custom-vine-submit-btn">Sign In</button>
				</div>
			{{Form::close()}}	
		</div>
	</div>
	<!-- <div class="row mt5">
		<div class="col-md-7 text-center login-remind-password" style="margin-left:160px;">
			<a href="{{route('remind_password')}}"> Forgot your password?</a>
		</div>
	</div> -->
</div>
</nav>
