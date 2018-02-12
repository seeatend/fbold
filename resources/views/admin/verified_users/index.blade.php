@extends('layouts.admin')
@section('main_header', 'Verified User')
@section('content')

@if(Session::has('rename_successfully'))
<div class="container flash-errors">
	<div class="row">
		<div class="col-md-8">
			<div class="alert alert-success">{{ Session::get('rename_successfully') }}</div>
		</div>
	</div>
</div>
@endif

<a href="{{ route('admin_add_verify_user') }}" class="btn btn-primary add_most_user_search_user">Add Verified User</a>

<table class="table table-striped table-verified-user" style="margin-top:65px;">
	<thead>
		<tr>
			<td>Id</td>
			<td>Image</td>
			<td>Name</td>
			<td>Type</td>
			<td>Actions</td>
		</tr>
	</thead>
	<tbody>
		@if(!empty($users))
		<?php $i=0; ?>

				@foreach($users as $user)
					<tr>
						<td> {{ ++$i }}</td>
						<td> <?php echo HTML::image($user->image_url, '', array('class' => 'admin_most_search_thumb')); ?> </td>
						<td>

							<?php Form::field([
								'name' 	=> "data[$i][id]",
								'type' 	=> 'hidden',
								'value' => $user->id,
							]); ?>

							{{{ $user->name }}}

						</td>

						<td> {{ ucfirst($user->type) }} </td>
						<td>

							<a class='btn btn-danger verify_most_search_user' onclick="return confirm('Do you really want to Remove this user ?')" data-id="{{$user->id}}" href="{{route('remove_verify_most_search_user',['type' => $user->id])}}">Remove</a>
						</td>
					</tr>
				@endforeach

		@else
		 <h3>No Record Found</h3>
		@endif
	</tbody>
</table>

@stop


