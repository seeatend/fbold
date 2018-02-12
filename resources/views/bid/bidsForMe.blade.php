{{-- RECEIVED --}}

@extends('layouts.simple')
@section('content')

<section id="received-container">
	<div class="container footer-setting">
		
       
		<h3>Received</h3>
		<div class="sort pull-right">
			{{--<p class="date-setting">Sort:</p>--}}
			 <select class="select-option" name="sort_by">
                <option value="{{route('bids_for_me', ['order_by' => 'date'])}}"   <?php if ($orderBy == "updated_at") echo "selected='selected'";?>>Date</option>
                <option value="{{route('bids_for_me', ['order_by' => 'amount'])}}" <?php if ($orderBy == "offer_price") echo "selected='selected'";?>>Amount</option>
            </select>
		</div>
	
		<div class="clearfix" style="height: 20px;"></div>
				
	
		    	
	<div class="receive-container">

		@if(!empty($bids))
		
		
			@if(empty($user->paypal_email))	
				<div class="notification-grey text-center receive-email-hide-show" data-attr='{{$user->paypal_email}}'>
					<div class="row">
					
						@if(Session::has('success_message'))
							<p class="alert alert-success receive-email-success" style="">{{{ Session::get('success_message') }}}</p>
						@else
							<p><b>Important:</b> Set your paypal email address in order to receive funds.</p>
						@endif
					
										
						<form action="{{route('do_paypal_email')}}" method="post" class="form-inline paypal-email">
							<div class="form-group paypal-email">
								<input type="email" name="paypal_email" value="{{$user->paypal_email}}" placeholder="Enter Paypal Email" id="email" class="display-paypal-email form-control receive-paypal-email-border">
							</div>
							<button class="btn" type="submit">Save</button>
						</form>
					
					
					</div>
				</div>
			@endif	

			@if(!empty($user->paypal_email))
				@if(Session::has('success_message'))
					<p class="alert alert-success receive-email-success" style="">{{{ Session::get('success_message') }}}</p>
				@endif
				<div style="margin-top:10px;"></div>
		@endif	
		
	
			@foreach($bids as $bid)
		
				
				@if($bid && $bid->is_hide == 1)
					
					
					
					<div class="bid-row">
						<div class="bid-column1">
							<div class="bid-profile-pic">
								<img src="{{$bid->present()->creatorAvatar}}" alt="avatar" class="avatar" height="60" width="60">
							</div>
						{{-- <i class="fa fa-{{$bid->service}}"></i> --}}
						</div>
						<div class="bid-column2">
						<div class="bid-header">
						
						
							
								<p class="bid-date">
								
									{{-- n/j/Y h:i A --}}
									
									
									{{ date('n/j/Y', strtotime($bid->updated_at)) }}
									<!-- <a href="{{route('hide_bid_for_me',['id' => $bid->id])}}" class="hide-bid-alert" data-attr="stopBidForMe"><span class="close">x</span></a> -->
								</p>
					
					

							<?php
								$display_msg = ""; 
								$follow_per_name = '';
								if($bid->status == ServiceBid::STATUS_NEW) {
									$display_msg = ' sent you a social task ';
								} 
								if($bid->status == ServiceBid::STATUS_DENIED) {
									$display_msg = "'s bid was denied by you ";
								}
								if($bid->status == ServiceBid::STATUS_ACCEPTED) {
									$display_msg = "'s social task was accepted by you ";
								}
	 							if($bid->status == ServiceBid::STATUS_COUNTERED_BY_CREATOR) {
			                        $display_msg = 'countered your bid';   
			                    } 
			                    if($bid->status == ServiceBid::STATUS_COUNTERED_BY_RECEIVER) {
			                        $display_msg = "'s social task was countered by you ";   
			                    }
			                    if($bid->service == 'instagram' && $bid->service_type == 'follow_back' && $bid->status == ServiceBid::STATUS_NEW) {
			                        $display_msg = ' sent you a social task ';   
			                    }
			                    // if($bid->service == 'instagram' && $bid->service_type == 'follow_back' && $bid->status == ServiceBid::STATUS_ACCEPTED) {
			                    // 	$display_msg = 'You are following to';   
			                    // }
			                    if($bid->status == ServiceBid::STATUS_COMPLETED) {
			                    	$display_msg = 'Social Task has been Completed';   
			                    }
			                    if($bid->status == ServiceBid::STATUS_COUNTERBID_ACCEPTED) {
	                                $display_msg = 'Your counter offer was accepted by';   
	                            }
			                    // if($bid->status == ServiceBid::STATUS_BID_CANCELLED) {
			                    // 	$display_msg = 'cancelled a bid';   
			                    // }
			                     if($bid->status == ServiceBid::STATUS_COUNTERBID_DENIED) {
			                    		$display_msg = 'Counter bid denied by';   
			                     }
			                    
							?>

							
							<div class="bid-instruction">
								@if($bid->status == ServiceBid::STATUS_COUNTERED_BY_CREATOR) 
									<h3>
										<?php //$socailUsername =  ($bid->present()->creatorSocialUsername()) ? $bid->present()->creatorSocialUsername() : $bid->getCreatorAnySocialUsername(); ?>
										<?php $socailUsername = $bid->findCreatorFollowbackUsername(); ?><a href="{{ $bid->url }}"><!-- <img src="{{$bid->avatar}}" alt="avatar" class="avatar" height="48" width="48" style="border-radius:50%;"> --><span> {{ $socailUsername }} </span>
										</a>
										countered your social task to
									<strong> {{$bid->present()->service_type}} </strong> {{--{ {$bid->present()->service}} --}} for <strong> {{$bid->present()->priceDecimal}} </strong></h3>
									
								 
								@elseif($bid->status == ServiceBid::STATUS_COMPLETED)
									<h3 class="bid-received-message">
									<?php //$socailUsername =  ($bid->present()->creatorSocialUsername()) ? $bid->present()->creatorSocialUsername() : $bid->getCreatorAnySocialUsername(); ?>
									<?php $socailUsername = $bid->findCreatorFollowbackUsername(); ?>
									<a href="{{ $bid->getCreatorSocialUrl() }}"> {{ $socailUsername }}'s </a> social task was accepted by you to
									 
									<strong> {{$bid->present()->service_type}} </strong> for <strong> {{$bid->present()->priceDecimal}} </strong>
									</h3>
								@elseif($bid->service == 'followback') 
									
									<h3 class="bid-received-message">
									<?php //$socailURL =  ($bid->getCreatorSocialUrl()) ? $bid->getCreatorSocialUrl() : $bid->getCreatorAnySocialUrl(); ?>
									<?php $socailURL = $bid->getSenderFollowbackProfileUrl(); ?>
									<?php //$socailUsername =  ($bid->present()->creatorSocialUsername()) ? $bid->present()->creatorSocialUsername() : $bid->getCreatorAnySocialUsername(); ?>
									<?php $socailUsername = $bid->findCreatorFollowbackUsername(); ?><a href="{{ $socailURL }}" data-attr="{{ $socailURL }}" acc-type="followback" data-followback-href="{{ $socailURL }}"><span> {{ $socailUsername }}</span>
									</a>{{{ $display_msg }}} to <strong> {{$bid->present()->service_type}} </strong>
									for <strong> {{$bid->present()->priceDecimal}} </strong></h3>
								
								@else

									{{{ $display_msg }}}
									<?php //$socailURL =  ($bid->getCreatorSocialUrl()) ? $bid->getCreatorSocialUrl() : $bid->getCreatorAnySocialUrl(); ?>
									<?php $socailURL = $bid->getSenderFollowbackProfileUrl(); ?>
									<?php //$socailUsername = ($bid->present()->creatorSocialUsername()) ? $bid->present()->creatorSocialUsername() : $bid->getCreatorAnySocialUsername(); ?>
									<?php $socailUsername = $bid->findCreatorFollowbackUsername(); ?><a href="{{ $socailURL }}" data-attr="{{ $socailURL }}" acc-type="followback" data-followback-href="{{ $socailURL }}">
										<!-- <img src="{{$bid->present()->creatorAvatar()}}" alt="avatar" class="avatar" height="48" width="48" style="border-radius:50%;"> -->
										<span> {{ $socailUsername }} </span>
									</a>
									to <strong> {{$bid->present()->service_type}} </strong>
									{{-- on <strong> {{$bid->present()->service}} </strong> --}}
									for <strong> {{$bid->present()->priceDecimal}} </strong>

								@endif  	
								
								
							</div>
						
                 
					
						
							
					

											@if($bid->file)
											
											<div class="row twocolumns">
												<div class="column1 left-media-wrapper">
													<span class="bid-media">
														<?php
															 preg_match_all('~<a(.*?)href="([^"]+)"(.*?)>~', $bid->present()->mediaForBidsList, $matches);
															 $img = array('jpg', 'png', 'gif');
															 $vid = array('mp4', 'mov', 'mpg', 'flv');
															 $ext = strtolower((isset($matches[2]) && !empty($matches[2])) ? pathinfo($matches[2][0], PATHINFO_EXTENSION) : '');
	 
															 	if(in_array($ext, $img)){
																	echo $bid->present()->mediaForBidsList;
																	$filename = $bid->file;
																	?>	 
																				 	 <p class="link-download" style="display: block; clear: both;"><strong><a href="/file.php?file=<?Php echo $filename; ?>&Expires=<?php echo time()+100; ?>" target="_blank" download="followback-{{ date('n-j-Y', strtotime($bid->updated_at)) }}-{{ $bid->findCreatorFollowbackUsername() }}-<?Php echo $filename; ?>">Download</a></strong></p> 
																	<?Php
																} else {
															
																
																
															
																					$s3 = App::make('aws')->get('s3');
																					$file = explode('?',$bid->file);
																					$filename = basename($file[0]);
																					$getextension =  explode('.',$filename);
																					$extension =  $getextension[1];
																					$photofile = str_replace("mp4","png",$filename);
																					$signedUrl = $s3->getObjectUrl('followback',$filename, '+10 minutes');
																					if($extension == "mp3"){ 
																					$Photo = "/assets/images/poster-audio.png";
																					} else {
																					$Photo = $s3->getObjectUrl('followback',$photofile, '+10 minutes');
													  								}
													  
													  
																				 ?>
																					  
															  <video poster="<?php echo $Photo; ?>" id="file{{ date('njYs', strtotime($bid->updated_at)) }}" class="bid-video video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" height="105" width="180" style="margin-left:auto;margin-right:auto;">
															  <source src="<?php echo $signedUrl; ?>"></video>
															  <script>videojs('file{{ date('njYs', strtotime($bid->updated_at)) }}', {"example_option":true}, function(){});</script>                   
															  <p class="link-download" style="display: block; clear: both;"><strong><a href="/file.php?file=<?php echo $signedUrl; ?>" target="_blank" download="followback-{{ date('n-j-Y', strtotime($bid->updated_at)) }}-{{ $bid->findCreatorFollowbackUsername() }}.mp4">Download</a></strong><span>File can't be downloaded on iPhone/iPad</span></p>
													 
																
									
														<?php } ?>
													</span>
												</div>
											
											<div class="column2 comment-text-wrapper">
										
												
												<div class="bid-instruction-container"><strong>Social task instructions: </strong><br> {{{ $bid->comment }}}</div>
										
											</div>
									
											
										</div>
											
											@else
											
											<div class="row onecolumn">
											
												<div class="column1 comment-text-wrapper">
												
													<div class="bid-instruction-container"><strong>Social task instructions: </strong><br> {{{ $bid->comment }}}</div>
										
												</div>
										
											
											</div>
											
											
											@endif
											
											
									
									{{Form::open(['route'=>['bid_counter_by_receiver',$bid->id],'class'=>'form-inline counterbid-form form','id'=>'Form'.$bid->id])}}
										
									<span class="utility-buttons">
										
											
												@if($bid->bid_type == 'bid' && in_array($bid->status,[ServiceBid::STATUS_NEW, ServiceBid::STATUS_COUNTERED_BY_CREATOR]) && !Sentry::getUser()->hasBlockedUser($bid->user->id))
													<!-- <a href="#" class="btn btn-dark-blue">Accept</a> -->
													
													<!-- <input type="hidden" class="hidden_bid_id" name="acceptId" value="{{$bid->id}}"> -->
													<a href="{{route('accept_bid_for_me',$bid->id)}}" class="btn btn-dark-blue hidden_bid_id" style="display:none"></a>
													
													<!-- <a href="#" class="btn btn-dark-blue accept-popup-donation">Accept</a> -->
													<a href="{{route('accept_bid_for_me',$bid->id)}}" class="cleanbutton accept receiver-accept-bid-btn alert" data-message="You will have 24 hours to fulfill this social task. Once accepted, it cannot be canceled. If the social task is not fulfilled, you can be banned. Please do not accept any social task that you feel strongly in disagreement with based on values, content or affiliations. Are you sure you want to accept this social task?">Accept</a>
													<input type="hidden" class="hidden_bid_amount" name="hiddenbidamount" value="{{$bid->present()->priceDecimal}}"> 
													<!-- Code for Donation popup --> 
													
												

													<!-- <a href="#" class="btn-group"><button class="btn btn-retro-package-3">Counter Offer</button><span class="btn btn-buoy-3"> > </i></span></a> -->
													@if($bid->status != ServiceBid::STATUS_DENIED)
														
															<input type="text" class="form-control counterform counter-offer-input" style="display: none;" name='price' placeholder="Counter">
															<!-- <span class="input-group-btn"> -->
																<a href="#" type="submit" class="cleanbutton counter counter-offer-btn  receiver-counter-offer-btn" data-check="sender" data-attr="CounterOffer" data-form="Form<?php echo $bid->id; ?>" style="float: left; margin: 0;">Counter</a>
															<!-- </span> -->
													
													@endif
													<!-- <a href="#" class="btn btn-sonic-threshold-5">Donate</a> -->
													<a class="cleanbutton deny not-interested alert" data-message="Once this social task is denied, the user will be notified that you have denied their social task and it will automatically get canceled. Are you sure you want to deny this social task?" href="{{route('deny_bid_for_me',$bid->id)}}">Deny</a>
												@endif	
												
												
												@if(!Sentry::getUser()->hasBlockedUser($bid->user->id))
													@if($bid->status != ServiceBid::STATUS_ACCEPTED &&  $bid->status != ServiceBid::STATUS_COUNTERBID_ACCEPTED)
														<a class="cleanbutton block block-user alert" data-message="Are you sure you want to block this user? You can always unblock them in the setting section." href="{{route('block_bids', $bid->user->id)}}">Block</a>
													@endif
												@else
													User already blocked.
												@endif
												
												<!-- If user accept any bid then Task Complete button should display -->
												
												@if($bid->status == ServiceBid::STATUS_ACCEPTED ||  $bid->status == ServiceBid::STATUS_COUNTERBID_ACCEPTED)
													<a href="{{route('task_completed', $bid->id)}}" class="cleanbutton complete alert" data-message="By pressing yes you will be notifying us that this task has been completed. Are you sure that this social task has been completed?">Task Completed</a>
												@endif
									
									
									</span>
									{{Form::close()}}
								
								
						
						</div>
						</div>
						<div class="clearfix" style="height: 30px;"></div>
					</div>

				@endif
			@endforeach	

		@else
			<div class="clearfix" style="height: 30px;"></div>
			  <h4 class="center-align-grey-msg nobids">You have not received any social tasks.</h4>
		@endif
		
		</div><!-- END: receive-container -->
		
			<nav>
				<div id="donation-container">
					<div class="donation-contents">
						<h3 style="margin-bottom:20px;">Donate a Set amount to charity
							<?php echo Input::get('acceptId'); ?>
						</h3>
						<p style="margin-bottom:20px;">
							Choose any charity to give a % of your earnings and support your cause. 
						</p>

						<form>
							<div class="charity-container">
								<?php $charityList = Config::get('concharities'); ?>
								@foreach($charityList as $name=>$charity)
								<div class="charity-box btn btn-default">
									{{ HTML::image($charity['icon_url'], $alt="", $attributes = array('height' => '60')) }} 
									<input type="radio" name="charity_name" class="select-cherity-input" style="margin-left: 40px;", value="$name" data-src="{{$charity['name']}}"/>
									<p style="padding-top:10px;text-align-center; font-size:11px;">{{$charity['name']}}</p>
								</div>
								@endforeach
							</div>	
						
							<div style="clear:both"></div>
							<div class="donate-amount-container pull_left">
								Bid Amount <span class="bid-amoount"></span> Amount you want to donate to <span class="donate-selected-charity"></span>:
								<input type="text" name="donate_amount" class="form-control donate-amount" placeholder="$0.00">
							</div> 

							<div class="donation-button">
								<a href="#" class="btn btn-danger donation-skip" style="height:34px;">Skip</a>
								<!-- <button class="btn btn-danger donation-skip">Skip</button> -->
								<!-- <button class="btn btn-danger donation-accept" type="submit" style="height:34px;">Accept</button> -->
								<button class="btn btn-danger donation-accept" type="submit" style="height:34px;">Accept</button>
							</div>
						</form>

					</div>
					
				</div>
			</nav>
				<!-- <div class="donation-button">
					<a href="{{route('accept_bid_for_me', 1234)}}" class="btn btn-danger donation-skip">Skip</a>
					
					<button class="btn btn-danger donation-accept" type="submit">Accept</button>
				</div> -->
			</form>
		</div>
		
	</div>
</div>
@stop

@section('js_include')

{{asset_javascript('handlecolorbox.js')}}
@stop
@section('js_inline')
<script>


	$( ".select-option" ).change(function() {
        var option = $(this).val();
        window.location.href = option;
    });

    var is_email_set = $('.receive-email-hide-show').attr('data-attr') 

    // if(is_email_set) {
    // 	$('.receive-email-hide-show').css('display', 'none');
    // }
</script>
@stop
@section('css_include')
@stop