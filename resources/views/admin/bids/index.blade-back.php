@extends('layouts.admin')
@section('main_header', 'Bids')
@section('content')

<table class="table table-striped" style="font-size:12px;">
	<thead>
		<tr>
			<td>Id</td>
			<td>Added By</td>
			<td>For Service/Username</td>
			<td>Service Type</td>
			<td>Price</td>
			<td class="wrap">Detail</td>
			<td>Status</td>
			<td>Payment Status</td>
			<td>Task Completed</td>
			<td>Media</td>
			<td>Created</td>
			<td>Delete</td>
		</tr>
	</thead>
	<tbody>

		@foreach($bids as $bid)
		<tr>
			<td>{{$bid->id}}</td>
			<td>{{ (isset($bid->user->email) && !empty($bid->user->email)) ? $bid->user->email : ''}}</td>
			<td>{{ucfirst($bid->service.' / '.$bid->username."(ID $bid->identifier)")}}</td>
			<td>{{ $bid->service_type }}</td>
			<td>{{$bid->present()->priceDecimal}}</td>
			<td> {{{ wordwrap($bid->comment, 8, "\n", true) }}}</td>
			<td>{{$bid->present()->status}}</td>
			<td>	
				@if(!empty($bid->orders))
					@if($bid->orders->first())
					{{ucfirst($bid->orders->first()->status)}}
					@endif
				@endif
				
			</td>
			<td>{{ ($bid->is_task_complete == 1) ? ' ---------- ' : 'No' }}</td>

			<td>
				<a href="<?php echo '/bids_images/'.$bid->file; ?>" target="_blank">
					{{ HTML::image('/bids_images/'.$bid->file, $alt="", $attributes = array('height' => '50','width' => '50')) }} 
				</a>
			</td>
			<td>{{ date('mdY', strtotime ($bid->created_at)) }}</td>
			<td><a href="{{ route('admin_bid_delete',['id'=> $bid->id]) }}" class="btn btn-danger">Delete</a> </td>
		</tr>
		@endforeach
	</tbody>
</table>
{{$bids->appends(Request::except('page'))->links()}}
@stop