@extends('layouts.simple')
@section('content')

<div id="connect">
	<div class="container payment-container">
		
		@include('.partials._settings-header-title')
		<div class="row connect-container">
			<div class="col-md-3">
					
						@include('partials._profile-sidebar')
		
			</div>
			<div class="col-md-9 cols1">
				<div class="account-content">
					<div class="paypal-content">
						<div class="clearfix" style="height: 30px;"></div>
						<h4>Set your paypal email address in order to receive funds.</h4>
					
						{{Form::open(['route' => 'do_paypal_email', 'class'=>'paypal-email', 'role'=>"form"])}}
							@if($user->paypal_email)
								<div class="form-group paypal-email">
										<input type="email" name="paypal_email" value="{{$user->paypal_email}}" placeholder="Enter Paypal Email" id="email" class="display-paypal-email paypal-input-box form-control receive-paypal-email-border" style="display:none;">
										<span class="flat-bar display-update-email paypal-enable-email">
						  					{{{ (strlen($user->paypal_email) > 18) ? substr($user->paypal_email,0,18).'...' : $user->paypal_email }}} 
										</span>
										<input style="margin-left: 0;" type="hidden" name="receive_paypal_input" value="profile_paypal_email" />
								</div>
								<button class="btn" type="submit" id="edit-paypal-email" data-attr='edit'>Edit</button>
							@else
								<div class="form-group paypal-email">
									<input type="email" name="paypal_email" value="{{$user->paypal_email}}" placeholder="Enter Paypal Email" id="email" class="display-paypal-email form-control receive-paypal-email-border">
								</div>
								<button class="btn" type="submit">Save</button>
							@endif
							{{ Form::close() }}
						</div>
					<div class="payment-works">
						<h4>How Payments Works</h4>
						<div class="payment-cols">
							<div class="row">
								<div class="col-md-6 payment-col">
									<img src="/assets/images/settings/bid.png" />
									<p style="text-align: left;">1.  Once you accept a social task, you have 24 hours to complete it. That social tasks must be continuously upheld for a minimum of thirty days in order to be credited with the completion of the social task. Any social task that is not honored by this policy will be issued a refund.</p>
								</div>
								<div class="col-md-6 payment-col">
									<img src="/assets/images/settings/task.png" />
									<p style="text-align: left;">Payments are sent on the 15th and 30th of each month. Individuals that receive higher than average volume of social tasks can request immediate Paypal payment or bank transfers at <a href="mailto:Request@followback.com?subject=Request Payment" style="color: #0100fb;">Request@followback.com</a>. Make sure to add your Paypal email address which is located above. <a href="#" class="popup-link" style="color: #0100fb;">Learn More</a></p>
								</div>
								
							</div>
						</div>
					</div>
					<div class="final-payments">
						<h4>Payments</h4>
						<div class="final-bid">
							<div class="bid-col">
								<h1>${{{ $bids['receive_bids'] }}}</h1>
								<h4>received bids</h4>
							</div>
							<div class="bid-col">
								<h1>${{{ $bids['accepted_bids'] }}}</h1>
								<h4>accepted bids</h4>
							</div>
							<div class="bid-col">
								<h1>${{{ $bids['sent_bids'] }}}</h1>
								<h4>sent Bids</h4>
							</div>
							<div class="bid-col active">
								<h1>$0</h1>
								<h4>DONATED TO CHARITY</h4>
							</div>
						</div>
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


	<div class="popup-overlay">
		<div class="box">
			<a href="#" class="popup-close"><ins class="fa fa-times"></ins></a>
			<h4 style="margin: 0 0 18px 0; color: #0100fb;">Payment Request</h4>
			
			<p>Are you a customer that receives a higher than average volume of completed social tasks? As long as there have been no prior complaints about uncompleted social tasks, feel free to submit a request at <a href="mailto:Request@Followback.com?subject=Payment Request" target="_blank" style="color: #0100fb;">Request@Followback.com</a> for immediate PayPal or bank transfers. We will review your account and get back to you in less than 48 hours.</p>
		</div>
	</div><!-- END: popup-overlay -->


@stop