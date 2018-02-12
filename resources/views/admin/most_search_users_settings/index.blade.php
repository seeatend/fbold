@extends('layouts.admin')
@section('main_header', 'Most Search Users Setting')
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

<a href="{{ route('admin_most_search_user_add') }}" class="btn btn-primary add_most_user_search_user">Add New User</a>
<?php echo Form::open(['route'=>'admin_most_search_user_rename', 'method' => 'POST' , 'class'=> '']); ?>
<table class="table table-striped" style="margin-top:65px;">
	<thead>
		<tr>
			<td>Id</td>
			<td>Image</td>
			<td>Name</td>
			<td>Display Order</td>
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

						<?php echo Form::field([
								'name' 	=> "data[$i][id]",
								'type' 	=> 'hidden',
								'value' => $user->id,
							]); ?>
						<?php echo Form::field([
								'name' 	=> "data[$i][name]",
								'type' 	=> 'text',
								'value' => $user->name,
								'class' => 'most_user_upate_name'
							]); ?>
						</td>
						<td>
						<?php echo Form::field([
								'name' 	=> "data[$i][display_order]",
								'type' 	=> 'text',
								'value' => $user->display_order,
								'class' => 'most_user_display_order'
							]); ?>
						</td>
						<td> {{ ucfirst($user->type) }} </td>
						<td>
							<a class='btn btn-danger delete_admin_most_search_user' onclick="return confirm('Do you really want to delete this record ?')" data-id="{{$user->id}}" href="{{route('admin_delete_most_search_user',['type' => $user->id])}}">Delete</a>
						</td>
					</tr>
				@endforeach


		@else
		 <h3>No Record Found</h3>
		@endif
	</tbody>
</table>
<button class="btn btn-primary admin_rename_search_user_button" type="submit">Update</button>
<?php Form::close(); ?>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	// var id;
	// var url;
	// $('.delete_admin_most_search_user').on('click', function() {

	// 	//var confirm = confirm("Do you really want to delete this record!!")
	// 	if (confirm("Do you really want to delete this record?")) {
	//         // your deletion code
	//         id   =  $(this).attr('data-id');
	// 		url  =  $('form.post_most_delete_user').attr( "action" );
	// 		//url = url+'/'+id;
	// 		alert(url);
	// 		$.ajax({
	// 		    url : url,
	// 		    type: "GET",
	// 		    data : {
	// 		    	'id'  : id,
	// 		    },
	// 		    success: function(data, textStatus, jqXHR)
	// 		    {
	// 		        alert(data);
	// 		    },
	// 		    error: function (jqXHR, textStatus, errorThrown)
	// 		    {
	// 		 		console.log("error");
	// 		    }
	// 		});
	//     }
	//     return false;
	// })
})
</script>
@stop


