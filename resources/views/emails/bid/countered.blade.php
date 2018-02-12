@extends('layouts.email')
@section('content')
<p style="color:#000001;padding:10px;background-color:#ffffc2;">You have just received social task update. Please click on the button below to see your update.</p>
<a href="{{route('bids_for_me')}}" class="Button" style=" box-sizing: border-box; border-radius: 5px; display: block; margin: 20px 0; padding: 12px 20px 12px; background-color: #0100fb; color: #FFF !important; font-weight: 600; width: 100%; text-align: center;">View counteroffer Update</a>

	
@stop		

