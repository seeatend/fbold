@extends('layouts.simple')

@section('content')
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 followback-form-top-margin">
		<h1 class='text-center'>Remind Password Completed</h1>
		On your e-mail address <b>{{$email}}</b> we sent an link to change your password. Use it to get access to your account.</div>
		<br/><a href='{{route('index')}}'>Back to home page</a>
	</div>

</div>
@stop