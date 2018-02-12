@extends('layouts.simple')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="text-center">
			<?php 
				$msg = ($exception->getMessage() != '') ? $exception->getMessage() : "404 Page Not Found."; 
				
				if (strpos($msg,'Got Http response code 400 when accessing https://api.paypal.com') !== false) {
   		 		
   		 		echo "<div title='".$msg."' style='padding: 30px; max-width: 600px; width: 90%; margin: 0 auto; background-color: #FEEFB3;'><span style='font-size: 50px; padding: 10px 10px 5px 10px; color: #9F6000;'><i class='fa fa-exclamation-triangle'></i></span><h3 style='color: #9F6000;'>There was an error with your PayPal Account.</h3><p style='color: #9F6000;'>We're sorry, but your transaction couldn't be completed using the selected card, This happened because it has been denied by the card issuer. Please check with your PayPal account.</p></div>";
				
				} else {
					
					echo "<div title='".$msg."' style='padding: 30px; max-width: 600px; width: 90%; margin: 0 auto; background-color: #FEEFB3;'><span style='font-size: 50px; padding: 10px 10px 5px 10px; color: #9F6000;'><i class='fa fa-exclamation-triangle'></i></span><h3 style='color: #color: #9F6000;'>404 Page Not Found</h3></div>";
				
				}
				
			?>
			
		</div>
	</div>
</div>
@stop