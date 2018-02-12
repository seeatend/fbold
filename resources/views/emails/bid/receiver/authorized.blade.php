@extends('layouts.email')
@section('content')

Congratulations! You just received a social task from <a href="{{$bidderSocialUrl}}">{{$bidderUsername}}</a>  to {{$service_type}} for {{$price}}. 
<a href="http://www.followback.com/received" class="Button" style=" box-sizing: border-box; border-radius: 5px; display: block; margin: 20px 0; padding: 12px 20px 12px; background-color: #0100fb; color: #FFF !important; font-weight: 600; width: 100%; text-align: center;">View Social Task</a>

@stop


