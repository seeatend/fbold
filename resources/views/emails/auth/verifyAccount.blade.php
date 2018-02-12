@extends('layouts.email')
@section('content')


      <p>Welcome to Followback, your social task provider! Get anyone to Followback, post, tweet, like, share or comment anywhere!</p>
      <p style="color:#000001;padding:10px;background-color:#ffffc2;">
        Please confirm your email address.
        You will not able to receive your social task notifications by email until you confirm.</p>
        
        <a href="{{route('confirm_email', $token)}}" class="Button" style=" box-sizing: border-box; border-radius: 5px; display: block; margin: 20px 0; padding: 12px 20px 12px; background-color: #0100fb; color: #FFF !important; font-weight: 600; width: 100%; text-align: center;">Click here to confirm your email</a>
   
  

@stop