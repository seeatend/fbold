@extends('layouts.email')
@section('content')

<p style="color:#000001;padding:10px;background-color:#ffffc2;">You have just received a counter bid notification. Please click on the button below to see your update.</p>
<a href="{{route('bids_for_me')}}" class="Button" style=" box-sizing: border-box; border-radius: 5px; display: block; margin: 20px 0; padding: 12px 20px 12px; background-color: #0100fb; color: #FFF !important; font-weight: 600; width: 100%; text-align: center;">View Counter Bid Update</a>
   

@stop


{{--
		<p>Counter bid accepted</p>
		<p>
			The counter offer you placed for your <b>{{$bid['username']}}</b> <b>{{ucfirst($bid['service'])}}</b> account and <b>{{$bidDescription}}</b> (<b>${{$bid['offer_price']}}</b>) created initially by {{$bidderUsername}} was accepted.
		</p><p>			
			You should finalize the bid now by taking proper action based on selected bid type then mark bid as completed <a href="{{route('bids_for_me')}}">here</a>.
		</p>
--}}