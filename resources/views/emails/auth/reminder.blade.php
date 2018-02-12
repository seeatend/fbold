@extends('layouts.email')
@section('content')


<p>
To reset your password, click the button below. This reset link will expire in {{ Config::get('auth.reminder.expire', 60) }} minutes.
</p>

<a class="Button" href='{{ URL::route('reset_password', ['token'=>$token]) }}' style="background-color: #0100fb;">Click here to reset your password</a>


@stop