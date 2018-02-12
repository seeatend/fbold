@extends('layouts.simple')

@section('content')

<div class="wrapper" id="about">
	<div class="masthead">
		<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Reset Your Password</h1>
			</div>
		</div>
		</div>
	</div>
	<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h2 class="header">Enter your new password.</h2>
			
		<?= Form::open(['route' => ['do_reset_password', $token]]); ?>
		<input type="hidden" name="token" value="{{ $token }}">
		<?= Form::field([
			'name' => 'password',
			'type' => 'password',
			'class' => 'password-image',
			'placeholder' => 'Enter New Password',
		]); ?>
		<?= Form::field([
			'name' => 'password_confirmation',
			'type' => 'password',
			'class' => 'password-image',
			'placeholder' => 'Repeat New Password',
		]); ?>
		<button type='submit' class="btn btn-lg btn-block btn-blue" style="max-width: 180px; font-size: 13px;">Save & continue</button>
		<p>By clicking "Save & Continue", you confirm that you accept the <a class="blue-effect">Term of Service</a> & <a class="blue-effect">Privacy Policy</a></p>
		<?= Form::close(); ?>
			
			
		</div>	
	</div>
	</div>
</div>








@stop