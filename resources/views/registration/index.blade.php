@extends('layouts.simple')
@section('content')
<div class="row" style="display:none;">
	
	<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 followback-form-top-margin">
		<h1 class='text-center'>Register</h1>
		{{Form::open(['route' => ['do_register']])}}
			{{Form::field([
				'name' => 'email',
				'label' => 'E-mail',
				'placeholder' => true,
				'value' => isset($socialUser['email']) ? $socialUser['email'] : null
				])}}
			{{Form::field([
				'name' => 'username',
				'label' => 'Username',
				'placeholder' => true,
				])}}

			{{Form::field([
				'name' => 'password',
				'label' => 'Password',
				'placeholder' => true,
				'type' => 'password'
				])}}
			
			<button type="submit" class="btn btn-default pull-left">Register</button>
		{{Form::close()}}
	</div>
</div>

@stop
@section('js_inline')
    <script>
        
        $(document).ready(function() {

        });

        $(window).load(function(){
        	var pathname = window.location.pathname; // Returns path only
			var url      = window.location.href;

			if(pathname == "/register") {
				$.colorbox({
			    	inline:true, 
			    	href:".register-content",
			    	width:"340px", 
			    	height:"550px",
			    	maxWidth: "95%",
			        maxHeight: "95%",
			    	scrolling:false,
			    	speed:5
			    });

			}

		});
    </script>
@stop