@extends('layouts.simple')
@section('content')

<?php 

$user_id = Sentry::getUser()->id; 

?>

<div id="connect">
	<div class="container">

		@include('.partials._settings-header-title')
		<div class="row connect-container">
			<div class="col-md-3 cols1">
				
						@include('partials._profile-sidebar')
		
			</div>
			{{--
			
			<div class="col-md-9">
				<div class="clearfix" style="height: 30px;"></div>
				<div class="account-content">
					@if($blockedUsers->count() > 0)
						<table class="table table-striped">
							<thead>
								<tr>
									<td>User</td>
									<td>Date blocked</td>
									<td>Unblock</td>
								</tr>
							</thead>
							<tbody>
								@foreach($blockedUsers as $user)
									<tr>
										<td>{{$user->username}}</td>
										<td>{{$user->pivot->created_at->format('n/j/Y')}}</td>
										<td><a href="{{route('unblock_bids', $user->id)}}" class="btn btn-default">Unblock</a></td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<p class="block-user-msg" style="text-align: center; font-weight:bold;">You have not blocked any users yet.</p>
					@endif

				</div>
			</div>
			
			--}}
		</div>
	</div>
</div>

<div class="row hidden">
	<div class="col-xs-12">
		<h1>Social Media Accounts</h1> 
		<?php  $social_icons = Config::get('conservices'); ?>
		<ul class="list-group">
			@if(!empty($social_icons))
				@foreach($social_icons as $social_icon)
					<?php 
						$name  =  		$social_icon['name'];
						$identifier  =  $social_icon['identifier'];
						$route =  		$social_icon['route'];
						$class_name =   $social_icon['class_name'];
						$icon       =   $social_icon['icon_name'];
						$connect_route = $social_icon['auth_connect_route'];
						$disconnect_route = $social_icon['auth_disconnect_route'];
						
					?>
					
					<li class="list-group-item">
						@if(!$user->hasSocialAccount($social_icon['identifier']))

							<a href="{{route($connect_route, ['type'=>$identifier])}}" class="btn btn-block btn-primary <?php echo $identifier; ?>">
								{{ $name }}
							</a>
						@else
							<a href="{{route($disconnect_route,['type'=>$identifier])}}" class="btn btn-block btn-danger">
								{{ $name }}
							</a>
						@endif
					</li>

				@endforeach
			@endif

			
		</ul>
	</div>
</div>

<div class="row hidden">
	<div class="col-xs-12">
		<h1>Your PayPal Email address</h1>
		<br>
		<form action="{{route('do_paypal_email')}}" method="post" class="form-inline">
			<div class="input-group">
				<input type="email" name="paypal_email" class="form-control"
							 placeholder="Enter email" value="{{$user->paypal_email}}" required>
				<span class="input-group-btn">
					<button class="btn btn-primary" type="submit">Save</button>
				</span>
			</div>
		</form>
	</div>
</div>

@stop