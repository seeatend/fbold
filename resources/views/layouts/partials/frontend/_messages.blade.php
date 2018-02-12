@section('messages')
<?php echo Flash::render('flash-errors'); ?>
@show
@section('errors')
@if($errors->has('error'))

		@foreach($errors->get('error') as $error)

					<div class="alert-message alert-danger">{{$error}} <a href="#" class="remove-alert"><ins class="fa fa-times"></ins></a></div>

		@endforeach

	@endif
@show