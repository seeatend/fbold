@extends('layouts.email')
@section('content')

        <p>Congratulations! You just received a {{$price}} payment from <a href="{{$bidderSocialUrl}}">{{$bidderUsername}}</a>
        to {{$service_type}} on {{$service}}. Please check your paypal account to confirm.</p>
        <p>You can contact our payment support division <a href="{{route('index')}}">here</a> in case of any issues.</p>
  
@stop
