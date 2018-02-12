@extends('layouts.email')
@section('content')

<p>We've received a request to reset your password. If you didn't make the request, just ignore this email. Otherwise, you can reset your password by clicking below:</p>
<a class="Button" href='{{ URL::route('reset_password', ['token'=>$token]) }}' style="background-color: #0100fb;">Click here to reset your password</a>


@stop