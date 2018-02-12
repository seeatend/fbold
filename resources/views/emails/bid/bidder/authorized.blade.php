@extends('layouts.email')
@section('content')

<p>
        Congratulations! You’ve just successfully sent an offer to <a href="{{$receiverSocialUrl}}">{{$receiverUsername}}</a>
        to {{$service_type}} on {{$service}} for {{$price}}. This charge is just a preauthorization,
        and you will not be charged unless your offer is accepted.
  </p>
  
  
  
<p>
        Was this a mistake? <a href="{{route('cancel_bid', $bidId)}}">Cancel</a>
        
  </p>
<p>
        You can contact our payment support division <a href="{{route('index')}}">here</a> in case of any issues.
</p>
@stop
