@extends('layouts.simple')
@section('content')

<style>
.paypal { color: #FFF; font-size: 19px; padding: 10px 15px; border: 1px solid #0100fb !important; background-color: #0100fb; border-radius: 5px;  } 
.paypal:link,
.paypal:hover { background-color: #000; color: #FFF; }
.container p a { color: #0100fb; }
.container p a:hover { color: #000; }
</style>
<div class="container" style="padding: 55px 30px 0 30px; margin-bottom: 100px;">
	<div style="max-width: 600px; width: 100%; margin: 0px auto 0 auto;  border: 1px solid #999; padding: 20px 28px 0 28px; -moz-box-shadow: 0 0 5px #ccc;-webkit-box-shadow: 0 0 5px#ccc;box-shadow: 0 0 5px #ccc;">
		<div>
				<h1 style="color: #0100fb; font-size: 30px; margin: 5px 0 25px 0; font-weight: bold;"><u>Bid accepted</u></h1>
		<h3>How to complete</h3>
		<span>
    
Nice! You have just accepted a social task. You now have 24 hours to fulfill the instruction associated with the social task or risk the possibility of being banned from using our services. Here at Followback, we believe that individuals should honor social tasks for a lifetime. Unfortunately, we cannot guarantee this. Therefore, we have a policy that social tasks must be continuously upheld for a minimum of thirty days in order to be credited with the completion of the social task or the money will be refunded back. Please note standard paypal fees do apply. 
    
          </span>
    	
    	<div class="pull-right" style="clear:both; margin-top:30px;">
    		<a href="{{route('bids_for_me')}}">
    			Back to Receive Bid Page
    		</a>
    	</div>
			
			
			<div class="clearfix" style="clear: both; display: block; height: 30px;"></div>
			
				
		</div>

	
	</div>
</div>



@stop




