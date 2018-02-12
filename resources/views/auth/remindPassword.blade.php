@extends('layouts.simple')
@section('content')


<div class="wrapper" id="about">
	<div class="masthead">
		<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Reset Password</h1>
			</div>
		</div>
		</div>
	</div>
	<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h2 class="header">Enter your e-mail address.</h2>
			
			<?= Form::open(['route' => 'do_remind_password']); ?>
			<p>Enter the email address you used to sign up  and we'll send you a link to reset you password.</p>
			<?= Form::field([
				'name' => 'email',
				'class' => 'user-image5',
				'placeholder' => 'E-mail',
			]); ?>
			<span class="remind-password-setting">
				<button type='submit' class="btn btn-lg btn-block btn-blue" style="max-width: 180px; font-size: 13px;">Send Reset Link</button>
				<!-- <a href="{{route('auth_login')}}">
					<button type='button' class="btn btn-lg btn-block btn-red">Send Reset Link</button>
				</a> -->
			</span>
			<?= Form::close(); ?>
			
			
		</div>	
	</div>
	</div>
</div>


@stop