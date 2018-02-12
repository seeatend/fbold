
@extends('layouts.simple')
@section('content')
{{--

<div class="container loginpage-container">
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
	<div class="loginpage-form">
	<h1 class="login-form-head">Log in</h1>		
	{{Form::open(['route'=>'do_auth_login'])}}
	{{Form::field([
		'name' =>'email',
		'label' => 'E-mail',
		'placeholder' => true,
	])}}
	{{Form::field([
		'name' =>'password',
		'label' => 'Password',
		'placeholder' => true,
		'type' => 'password'
	])}}
	<p><input name="remember" id="checkboxG4" class="css-checkbox" type="checkbox"><label for="checkboxG4" class="css-label">Remember me</label></p>
	<button type="submit" class="btn btn-default">Login</button>
	{{Form::close()}}
	<div class="login-remind-password">	
	<a href="{{route('remind_password')}}">Remind Password</a> | <a href="{{route('index')}}">Back to homepage</a> | <a class="register-form-colorbox cboxElement" href="">Sign up</a>
	</div>
	</div>
</div>
</div>
<!-- <div class="row mt10">
	<div class="col-md-12 text-center login-remind-password">
	<a href="{{route('remind_password')}}">Remind Password</a> | <a href="{{route('index')}}">Back to homepage</a>
	</div>
</div> -->
</div>

--}}



@stop

@section('js_include')
	<script>
	
			window.location = "/?login=1";
			//$(".login-form-colorbox").first().click();
	

	</script>
@stop