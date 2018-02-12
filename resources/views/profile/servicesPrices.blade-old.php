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

					<div class="profile-options">
						<h4>{{{$title}}}</h4>
						<div id="service-prices" style="padding-top:0px;">
							<div class="contain-wrapper">

      
		
		<!-- <span class="help pull-right" data-toggle="tooltip" data-placement="bottom" title="Please do not accept any bid for a social media task which you feel strongly in disagreement with (in terms of its values, content or affiliations).Preauthorizations may only last up to 72 hours in some cases."><i class="fa fa-question-circle"></i>help</span> -->
		
		<div class="task-prices-tabs">
		
			<!-- My Changes -->
			<div id="accordion" class="accordion">
			<h3 class="ac-li">
				<a class="btn btn-mfast-2" href="" role="tab" data-toggle="tab" style="border:none;">
					<i class="fa-taxi ac-icon"></i>	
					<input type="radio" name="test"> Facebook
				</a>
			</h3>
			<div class="ac-para">
				<p>
					Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
					ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
					amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
					odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
				</p>
			</div>
			<h3 class="ac-li">
				<a class="btn btn-mfast-2" href="" role="tab" data-toggle="tab" style="border:none;" >
					<i class="fa-taxi ac-icon"></i>	
					<input type="radio" name="test"> Twitter
				</a>
			</h3>
			<div class="ac-para">
				<p>
					Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
					purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
					velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
					suscipit faucibus urna.
				</p>
			</div>
			<h3 class="ac-li">
				<a class="btn btn-mfast-2" href="" role="tab" data-toggle="tab" style="border:none;" >
					<i class="fa-xing ac-icon"></i>	
					<input type="radio" name="test"> Youtube
				</a>
			</h3>
			<div class="ac-para">
				<p>
					Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
					purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
					velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
					suscipit faucibus urna.
				</p>
			</div>
		</div>
		<!-- My Changes -->

			<!-- Nav tabs -->

			<?php $social_icons = Config::get('conservices'); ?>
				<ul class="price-tabs" role="tablist" id="services-selection">
				
					@if(!empty($social_icons))
						@foreach($social_icons as $social_icon)
							<?php 
								$is_active='';
								if($social_icon['identifier'] === $defaultService) {
									$is_active = 'active'; 
								}
							?>
							
								<?php 
									$name  =  $social_icon['name'];
									$lower_case_name = strtolower($name);
									$identifier  =  $social_icon['identifier'];
									$route =  $social_icon['route'];
									$class_name =  $social_icon['class_name'];
									$icon       =  $social_icon['icon_name'];
									$set_task_pricesocial_icon = $social_icon['set_task_pricesocial_icon'];
								?>						
								
								@if($social_icon['display_flag'])
									<li class="{{$is_active}}" data-service="{{$lower_case_name}}">
										<a class="btn btn-mfast-2" href="" data-identifier="{{ $identifier }}" href="{{ $identifier }}" role="tab" data-toggle="tab" style="border:none;" >
											<i class="fa <?php echo $set_task_pricesocial_icon; ?>"></i>	
											<input type="radio" name="test"> {{$name}}
										</a>
									</li>
								@endif

			    		@endforeach	
				 	@endif
				</ul>
			<div class="line"></div>

<!-- **************************************************************************************************  -->
		<div class="tab-title text-center" id="help-text-connect" style="">
			Your account is not linked to <span class="text-capitalize help-service-name not-linked-service">{{$defaultService}}</span>.
			<div class="bottom-section">
				<div class="social-btn text-center"> 
					<a href="" class="connect-href-attr">
						<div class="btn-group">
							<button class="connect-btn btn btn-blue <?php echo $identifier.'-colorbox'; ?> social-media-buttons" id="<?php echo 'onclick-'.$identifier; ?>">
								
								<i class="fa"></i>
								
								<span class="join-social-button-name"></span>
							</button>
						</div>
					</a>
				</div>
			</div>
		</div>

			<!-- Tab panes -->
			
			<div class="tab-content">
			  <div class="tab-pane fade active in" id="">
			  	<div class="tab-title help-service-name" id="help-text">Set your minimum bid or pay now price to perform social media tasks on {{$defaultService}}</div>
			  	<div class="minimum-bid">

			  		{{Form::open(['route' => 'do_profile_services_prices', 'class'=>'bv-form form-inline set-min-price-form' , 'id'=>'target'])}}

			  			@foreach($servicesList as $service => $options)

							<div id="{{$service}}" class="services-list-item" style="{{ $defaultService !== $service ? 'display:none' : '' }}">
						  		@foreach($options as $option => $settings)
	
						  			@if($settings['description'] == 'Choose Option')
						  				<?php continue; ?>
						  			@endif

							  		<div class="bid-col">
							  			<div class="bid-title">
							  				<h4>{{$settings['description']}}</h4>
							  			</div>
							  			<div class="bid-btn price-bid-btn">
							  				<?php  
							  					$on_or_off = '';
							  					$checked = '';
							  					if(!isset($userPrices[$service][$option]['type']) && empty($userPrices[$service][$option]['type'])) {
							  						$on_or_off = 'on';
							  						$checked = 'checked';
							  					}

							  				?>
							  				<span class="btn switch-button-label {{(isset($userPrices[$service][$option]['type']) and $userPrices[$service][$option]['type'] === 'bid') ? 'on' : 'off'}}">
												{{Form::radio("services[$service][$option][type]", 'bid', isset($userPrices[$service][$option]['type']) and $userPrices[$service][$option]['type'] === 'bid', 
													array(
														'data-attr' => 'bid'
													)
												)}}
												Bid
											</span>
											<span class="btn switch-button-label {{(isset($userPrices[$service][$option]['type']) and $userPrices[$service][$option]['type'] === 'fixed') ? 'on' : 'off'}}">
												{{Form::radio("services[$service][$option][type]", 'fixed', isset($userPrices[$service][$option]['type']) and $userPrices[$service][$option]['type'] === 'fixed', 
													array(
														'data-attr' => 'pay now'
													))
												}}
												Pay Now
											</span>
							  			</div>
							  			<div class="form-group">
							  				<!-- <input type="text" name="price" placeholder="Your minimum bid price" class="form-control" /> -->
							  				@if(isset($userPrices[$service][$option]['price']))
								  				<span class="flat-bar min-price-flat-bar">
								  					<?php  
								  						echo isset($userPrices[$service][$option]['price']) ? substr($userPrices[$service][$option]['price'], 0, 10) : ''; 
				                                        if(strlen($userPrices[$service][$option]['price']) > 10) 
				                                            echo '...';
								  					?>
								  					
								  					<i class="fa fa-edit pull-right min-price-edit-icon"></i>
								  				</span>
								  				{{Form::field([
													'name' => "services[$service][$option][price]",
													'label' => false,
													'placeholder' => 'Your minimum bid price',
													'class' => 'form-control hide-price-input hide-price-styling',
													'value' => isset($userPrices[$service][$option]['price']) ? $userPrices[$service][$option]['price'] : null,	
													array(
														'style' => 'display:none;'	
													)
													
												])}}
											@else
												{{Form::field([
													'name' => "services[$service][$option][price]",
													'label' => false,
													'placeholder' => 'Your minimum bid price',
													'class' => 'form-control min-price-input-field',
													'value' => isset($userPrices[$service][$option]['price']) ? $userPrices[$service][$option]['price'] : null,	
													
												])}}
											@endif
							  			</div>
							  		</div>
							  		<div class="border-bottom"></div>
							  	@endforeach
							  	<div class="text-right save-btn price-save-button">
							  		
							  		<button class="btn btn-default price-reset-btn reset-price-confimation" data-href="{{ route('do_profile_services_prices') }}" type="submit" data-attr='{{ $service }}' data-service="{{ $service }}">Reset</button>
							  		&nbsp;&nbsp;
							  		<button class="btn btn-dark-blue check-empty-input" type="submit" data-attr='{{ $service }}'>Save</button>
							  	</div>
							</div>
						@endforeach
				  	{{ Form::close() }}	

			  	</div>
			  </div>
			 
			</div>
		</div>
	</div>
</div> 	</div>



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


@section('js_include')
		{{asset_javascript('plugins/bower/bootstrapValidator/dist/js/bootstrapValidator.min.js')}}
		{{asset_javascript('handlecolorbox.js')}}
	@stop

	@section('js_inline')
		<script>
			var BASE_PATH = "<?php echo config::get('otherconstants.BASE_URL'); ?>";  
			var defaultService = "<?php echo $defaultService ?>";
			$('.bv-form').bootstrapValidator();

			$(window).load(function(){

			    var lastTabb = localStorage.getItem('lastTab'); 
			    // $('.connect-btn i').addClass('fa-'+lastTabb);
			   	// $('.connect-btn').addClass(btnColor(lastTabb));

			   	// $('.join-social-button-name').text('Click to connect');
			    // $('a.connect-href-attr').attr('href', '/connect/'+lastTabb);
			    //$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			    var $deaultSer = defaultService;
			    if(lastTabb) {
			    	$deaultSer = lastTabb;
			    }	
			    $('.connect-btn i').addClass('fa-'+$deaultSer);
			    //alert(deaultSer);
			   	$('.connect-btn').addClass(btnColor($deaultSer));

			   	$('.join-social-button-name').text('Click to connect');
			    $('a.connect-href-attr').attr('href', '/connect/'+$deaultSer);

			    //$('#services-selection li').trigger('click');
				showHideServices($deaultSer);
			});

			$('#services-selection li').on('click', function (e) {
				
				//var service = $(e.target).parent().data('service');
				var service = $(this).data('service');
				showHideServices(service);
			});


			//Get las tab if saved and displat it after save
			var lastTab = localStorage.getItem('lastTab');
			if (lastTab) {
				$('ul#services-selection li').find("[data-identifier='" + lastTab + "']").click();
			}

		    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		    	
			   var active_tabs = $(e.target).attr('data-identifier');
			   localStorage.setItem('lastTab', $(e.target).attr('data-identifier'));

			   if(active_tabs == 'facebook') {
			   		$('.connect-btn').removeClass('btn-info btn-green btn-red btn-brown');

			   		$('.connect-btn i').removeClass('fa-instagram fa-youtube fa-vine fa-twitter');

			   		$('.connect-btn i').addClass('fa-facebook');
			   		$('.connect-btn').addClass(btnColor(active_tabs));
			   }  if(active_tabs == 'twitter') {

			   		$('.connect-btn').removeClass('btn-blue btn-green btn-red btn-brown');
			   		$('.connect-btn i').removeClass('fa-instagram fa-youtube fa-vine fa-facebook');

			   		$('.connect-btn i').addClass('fa-twitter');
			   		$('.connect-btn').addClass(btnColor(active_tabs));
			   }  if(active_tabs == 'vine') {

			   		$('.connect-btn').removeClass('btn-blue btn-info btn-red btn-brown');
			   		$('.connect-btn i').removeClass('fa-instagram fa-youtube fa-twitter fa-facebook');

			   		$('.connect-btn i').addClass('fa-vine');	
			   		$('.connect-btn').addClass(btnColor(active_tabs));
			   }  if(active_tabs == 'youtube') {

			   		$('.connect-btn').removeClass('btn-blue btn-info btn-green btn-brown');
			   		$('.connect-btn i').removeClass('fa-instagram fa-twitter fa-vine fa-facebook');

			   		$('.connect-btn i').addClass('fa-youtube');	
			   		$('.connect-btn').addClass(btnColor(active_tabs));
			   }  if(active_tabs == 'instagram') {

			   		$('.connect-btn').removeClass('btn-blue btn-info btn-green btn-red');
			   		$('.connect-btn i').removeClass('fa-twitter fa-youtube fa-vine fa-facebook');

			   		$('.connect-btn i').addClass('fa-instagram');	
			   		$('.connect-btn').addClass(btnColor(active_tabs));
			   }

			   $('.join-social-button-name').text('Click to connect');
			   $('a.connect-href-attr').attr('href', '/connect/'+active_tabs);
			   //$('.connect-btn i').addClass('fa-'+active_tabs);
			});
		
			function btnColor(identifier) {
				var color = '';
				if(identifier == 'facebook') {
					color = 'btn-blue';
				} else if(identifier == 'twitter') {
					color = 'btn-info';
				} else if(identifier == 'youtube') {
					color = 'btn-red';
				} else if(identifier == 'instagram') {
					color = 'btn-brown';		
				} else if(identifier == 'vine') {
					color = 'btn-green';
				}
				return color;

			}

			function showHideServices(service) {
				
				$('.services-list-item').hide();

				// if service is not connected show help text, otherwise show prices list
				if ($('#' + service).length == 0) {

					//$('.help-service-name').
					$('.not-linked-service').text(service);
					$('#help-text').hide();
					$('#help-text-connect').show();
				}
				else {
					$('#' + service).show();
					$('.help-service-name').html("Set your minimum bid or pay now price to perform social media tasks on "+service)
					$('#help-text-connect').hide();
					$('#help-text').show();
				}	
			} 
		</script>
	@stop

	@section('css_include')
		{{asset_stylesheet('plugins/bootstrapValidator/dist/css/bootstrapValidator.min.css')}}
	@stop
