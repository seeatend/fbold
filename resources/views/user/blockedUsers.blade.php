@extends('layouts.frontend')
@section('content')
<div class="row plr40">
	<div class="col-xs-12">
		<h1>Blocked Users</h1>
		@if($blockedUsers->count() > 0)
		<table class="table table-striped">
			<thead>
				<tr>
					<td>User e-mail</td>
					<td>Blocked date</td>
					<td>Unblock</td>
				</tr>
			</thead>
			<tbody>
				@foreach($blockedUsers as $user)
					<tr>
						<td>{{$user->email}}</td>
						<td>{{$user->pivot->created_at->format('Y-m-d')}}</td>
						<td><a href="{{route('unblock_bids', $user->id)}}" class="btn btn-primary">Unblock</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
		@else
		<p>You did not block bids from any user.</p>
		@endif
	</div>
</div>

@stop