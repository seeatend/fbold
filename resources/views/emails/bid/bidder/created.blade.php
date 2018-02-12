@extends('layouts.email')
@section('content')

<p>
        Congratulations! Your payment to <a href="{{$receiverSocialUrl}}">{{$receiverUsername}}</a>
        of {{$price}} has succesfully been sent for {{$service_type}} on {{$service}}.
        Please check your paypal account to confirm.
 </p>

<p>
        You can contact our payment support division <a href="{{route('index')}}">here</a> in case of any issues.
</p>

@stop
