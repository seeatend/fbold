@section('messages')
<?php echo Flash::render('flash-errors'); ?>
@show
@section('errors')
@if($errors->has('error'))
	<div class="container">
		@foreach($errors->get('error') as $error)
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">&times;</button>{{$error}}</div>
				</div>
			</div>
		@endforeach
	</div>
@endif
@show