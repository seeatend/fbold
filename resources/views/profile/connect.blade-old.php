@extends('layouts.simple')
@section('content')

<div id="connect">
	<div class="container footer-setting">

		@include('.partials._settings-header-title')
		<div class="row connect-container">
			<div class="col-md-3">
				<div class="account-sidebar">
					<ul>
						@include('partials._profile-sidebar')
					</ul>
				</div>
			</div>
			<div class="col-md-9">
				<div class="account-content">
					<div class="sync-media">
						<h4>Sync your social media accounts with Followback</h4>
						<div class="media-options">

							<?php  $social_icons = Config::get('conservices'); ?>
								
								@if(!empty($social_icons))
									@foreach($social_icons as $social_icon)
										@if($social_icon['display_flag'])

											<?php 
												$name  =  		$social_icon['name'];
												$identifier  =  $social_icon['identifier'];
												$route =  		$social_icon['route'];
												$connect_route = $social_icon['auth_connect_route'];
												$disconnect_route = $social_icon['auth_disconnect_route'];
												$set_task_pricesocial_icon = $social_icon['set_task_pricesocial_icon']
											?>

										@if(!$user->hasSocialAccount($social_icon['identifier']))
										<div class="button-container">
											<a href="{{route($connect_route, ['type'=>$identifier])}}" class="social-media-col <?php echo $identifier.'-connect-colorbox'; ?>">
												<div class="media-box">
													<i class="fa {{$set_task_pricesocial_icon}}"></i>
													<p>{{{ $name }}}</p>
												</div>
												<img src="/assets/images/settings/social-box-shadow.png" />
												<div class="connection"><p>not yet connected</p></div>
											</a>
											</div>
										@else	
										  <div class="button-container button-container-wrapper">
											<a href="{{route($disconnect_route,['type'=>$identifier])}}" class="social-media-col active">
												<div class="media-box">
													<i class="fa {{$set_task_pricesocial_icon}}"></i>
													<p>{{{ $name }}}</p>
												</div>
												<img src="/assets/images/settings/social-box-shadow.png" />
												<div class="connection">
													<i class="fa fa-check-circle"></i><p>connected</p>
													<button class="btn btn-retro-package-3 btn-disconnect" href="#">Disconnect</button>

												</div>
											</a>
											<a href="{{route('social_acc_disconnect',['type'=>$identifier])}}" class="btn btn-blue btn-resetting">
												Reset
											</a>
										</div>
										@endif
										@endif	
									@endforeach
								@endif
						</div>
						@include('layouts.partials.homepage._colorbox._vineconnectcolorbox')
					</div>

				</div>
			</div>
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
