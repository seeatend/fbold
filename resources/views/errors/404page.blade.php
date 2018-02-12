<?php
			header('HTTP/1.1 404 Not Found');
			header("Status: 404 Not Found");
?>
@extends('layouts.simple')
@section('content')


<div class="row">
	<div class="col-xs-12">
		<div class="text-center">
		
					
					<div title='".$msg."' style='padding: 30px; max-width: 600px; width: 90%; margin: 0 auto; background-color: #FEEFB3;'><span style='font-size: 50px; padding: 10px 10px 5px 10px; color: #9F6000;'><i class='fa fa-exclamation-triangle'></i></span><h3 style='color: #color: #9F6000;'>404 Page Not Found</h3></div>
				
				

			
		</div>
	</div>
</div>
@stop