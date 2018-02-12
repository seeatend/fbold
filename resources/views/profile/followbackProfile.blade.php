<?php

		$body_class = "PageSettings bg-white";

?>

@extends('layouts.simple')
@section('content')

<?php 
	$user_id = \Sentry::getUser()->id; 
?>

<div id="settings-content">
	<div class="container">
		<div class="row">
			<div id="settings" class="col-md-12">
				@if(Sentry::check() && Sentry::getUser()->email_verified == 0)
            	<div class="resend-confirmation-message">
						<ins class="fa fa-envelope text-blue"></ins> &nbsp; <strong>Please confirm your email<span class="show-desktop-inline"> address</span>. <span class="text-right"><a class="SendMail button btn-lightpurple" href="{{ route('do_resend_confirmation_email') }}">Resend</a> <a class="SendMail SendLater show-desktop-inline" href="#">Later</a></span></strong> 
               </div>
               <div class="clearfix"></div>
       		@endif
        	
        <div class="row">
    		<div class="col-md-10  col-md-offset-1">
    		<div id="settings-toggle" class="btn-group btn-group-justified">
            <div class="btn-group">
              <button id="setting_btn" type="button" class="active btn btn-default" role="tab" data-toggle="settings-tab">Account</button>
            </div>
            <div class="btn-group">
              <button id="blocked_users_btn" type="button" class="btn btn-default" role="tab" data-toggle="blocked-tab">Blocked Users</button>
            </div>
          </div>
    		</div>
    	</div>
      
      <div class="clearfix" style="height: 30px;"></div>  
        
      <div id="settings-tab">
          <div class="row">
          
				

            <?php
            $img = !empty(\Sentry::getUser()->avatar) ?
              \Sentry::getUser()->avatar :
              '/assets/images/homepage/default-user.png';
            ?>
            <div id="bidUpload" class="profile-upload col-md-1 col-md-offset-1 text-center col-xs-12">

              <?php echo Form::open(
                [
                  'route' => ['do_update_profile_pic'],
                  'class' => 'upload-profile-pic',
                  'id' => 'profile-upload-form'
                ]
              ); ?>
              <input type="hidden" name="id" value="{{ \Sentry::getUser()->id }}"/>
              <input id="field-temp-name" type="hidden" name="file_temp_name" value="{{ $img }}"/>
              <small class="help-block error-help1"></small>

              <a id="profile-photo-submit" href="#" alt="Click to upload new" class="settings_profile_photo js-fileapi-wrapper" style="background-image: url({{ $img }});">
                <div class="upload_overlay img-circle">
                  <div class="upload_overlay_inner js-browse">
                    <i class="fa fa-camera"></i><br/>Upload
                  </div>
                </div>
                <input id="upload-btn" title='Upload Photo' type="file" name="file">
              </a>

              <div class="js-upload" style="height:31px; width: 100%; margin: 0 auto; text-align: center;">
                <div class="progress progress-success" style="display: inline-block; position:relative;height:20px; width: 100px; margin: 0 auto;">
                  <div class="js-progress bar" style="position:absolute;height:20px;padding-top:30px;"></div>
                </div>
              </div>

              <?php echo Form::close(); ?>
            </div>

            <?php  $all_status = \Config::get('notificationconstants'); ?>

            <div class="col-md-8 col-md-offset-1">
              <div id="settings_form">
						<div class="row">							
							{{-- Name --}}
							<div class="col-md-6">
								<?php echo Form::open(
									 [
										'route' => 'do_change_name',
										'class' => 'update-name',
										'role' => "form"
									 ]
								); ?>
               			<div class="form-group">
                  			<label for="name" class="fieldlabel">Name&nbsp;<a href="#" class="info"><span>Your name displayed on your Followback profile.</span><ins class="fa fa-question-circle"></ins></a></label>
                  			<input id="name-input" name="name" type="text" maxlength="23" class="form-control" placeholder="John Doe" value="{{ \Sentry::getUser()->name }}">
                  			<input type="hidden" name="userId" value="{{ \Sentry::getUser()->id }}"/>
                			</div>
                			<div id="name-actions" style="display: none;">
                  			<button class="btn btn-default btn-change_name_save" data-attr="save" data-id="{{\Sentry::getUser()->id}}">Save</button>
                  			<a class="btn-change_name_cancel btn" href="#">Cancel</a>
                			</div>
                			<?php echo Form::close(); ?>
        										
							</div>
					 
                		{{-- email --}}
							<div class="col-md-6">
								<?php echo Form::open(
								  [
									 'route' => 'do_change_email',
									 'class' => 'update-email',
									 'role' => "form"
								  ]
								); ?>
								<div class="form-group">
								  <label for="email" class="fieldlabel">Email</label>
								  <input id="email-input" name="email" type="email" class="form-control update-email-input" placeholder="johnmayer@gmail.com" value="{{ \Sentry::getUser()->email }}" data-id="{{\Sentry::getUser()->id}}">
								  <input type="hidden" name="userId" value="{{ \Sentry::getUser()->id }}"/>
								</div>
								<div id="email-actions" style="display: none;">
								  <button class="btn btn-default btn-change_email_save" data-attr="save" data-id="{{\Sentry::getUser()->id}}">Save</button>
								  <a class="btn-change_email_cancel btn" href="#">Cancel</a>
								</div>
								<?php echo Form::close(); ?>
							</div>
						</div>
						<div class="row">
	
							{{-- username --}}
							<div class="col-md-6">
								<?php echo Form::open(
								  [
									 'route' => 'do_change_username',
									 'class' => 'update-username',
									 'role' => "form"
								  ]
								); ?>		
							
								<div class="form-group">
                  			<label for="username" class="fieldlabel">Username <a href="#" class="info"><span>Your Followback page: followback.com/{{ \Sentry::getUser()->username }}</span><ins class="fa fa-question-circle"></ins></a></label>
                  			<input id="username-input" name="username" type="text" maxlength="23" class="form-control" placeholder="username" value="{{ \Sentry::getUser()->username }}">
                  			<input type="hidden" name="userId" value="{{ \Sentry::getUser()->id }}"/>
                			</div>
                			<div id="username-actions" style="display: none;">
                  			<button class="btn btn-default btn-change_username_save" data-attr="save" data-id="{{\Sentry::getUser()->id}}">Save</button>
                  			<a class="btn-change_username_cancel btn" href="#">Cancel</a>
                			</div>
                			<?php echo Form::close(); ?>
							</div>
							
							{{-- paypal --}}
							<div class="col-md-6">
								<?php echo Form::open(
								  [
									 'route' => 'do_change_paypal',
									 'class' => 'update-paypal',
									 'role' => "form"
								  ]
								); ?>		
								<div class="form-group">
									<label for="paypal" class="fieldlabel">Paypal <a href="#" class="info"><span>Enter the paypal email address where you want your funds to be sent when a social media task is completed by you.</span><ins class="fa fa-question-circle"></ins></a></label>
									<input id="paypal-input" name="paypal" type="email" class="form-control" placeholder="paypal email" value="{{ \Sentry::getUser()->paypal_email }}">
                  			<input type="hidden" name="userId" value="{{ \Sentry::getUser()->id }}"/>
                			</div>
                			<div id="paypal-actions" style="display: none;">
                  			<button class="btn btn-default btn-change_paypal_email" data-attr="save" data-id="{{\Sentry::getUser()->id}}">Save</button>
                  			<a class="btn-change_paypal_cancel btn" href="#">Cancel</a>
                			</div>
                			<?php echo Form::close(); ?>
							</div>
							
						</div>

                <?php echo Form::open(
                  [
                    'route' => 'do_change_notification',
                    'class' => 'do_change_notification'
                  ]
                ); ?>
                <input id="email-notification" type="hidden" name="notification" value="<?php echo $notifications_status; ?>" class="notification-input">
                <?php echo Form::close(); ?>

                <div class="form-group" style="margin-bottom: 11px;">
                
                @if(Sentry::check() && Sentry::getUser()->email_verified == 0)
                	
                @else
                	<div class="clearfix" style="height: 10px;"></div>
                  <div class="row">
                    <div class="col-xs-6 col-sm-9 col-md-9">
                      <label for="notifications" class="fieldlabel" style="margin-top: 5px;">Receive email notifications?&nbsp;<a href="#" class="info"><span>Receive notification on social media task requests.</span><ins class="fa fa-question-circle"></ins></a></label>
                    </div>
                    <div class="col-xs-4 col-xs-offset-2 col-md-offset-0 col-sm-offset-0 col-lg-offset-0 col-sm-3 col-md-3">
                      <input name="notifications" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-style="followback" data-size="medium" @if($notifications_status == '0') checked @endif>
                    </div>
                  </div>
               @endif
                </div>
                
                @if(isset($userSocial))
               <div class="row">
               	<div class="col-xs-12 col-sm-12 col-md-12">
               		<h2 style="font-size: 20px; margin: 15px 0 10px 0; padding: 30px 0 10px 0; border-top: 1px dotted #ccc; font-weight: 600;">Promote your Followback page:</h2>
               		
   
               		<label class="fieldlabel" style="width: 100%; position: relative;">Bio: <a href="#" class="info"><span>You have 100 characters to describe yourself.</span><ins class="fa fa-question-circle"></ins></a>  <div class="charNum" style="position: absolute; bottom: -5px; right: 5px;"></div></label>
               		 <?php echo Form::open(
                  		[
                    		'route' => 'do_update_about',
                    		'class' => 'do_update_about about-update'
                  		]
                		   ); ?>
                  		<textarea  class="profile-headline" maxlength="100" data-gate="verify" data-id="{{\Sentry::getUser()->id}}" autocomplete="off" data-value="{{ $userSocial->about }}" name="about" placeholder="I am a ... ">{{ $userSocial->about }}</textarea>
                  		<div class="checker"></div>
                  		<div id="about-actions" style="display: none; float: left; margin: -7px 0 10px 0;">
                  			<button class="btn btn-default btn-about_save" data-attr="save" data-id="{{\Sentry::getUser()->id}}">Save</button>
                  			<a class="btn-about_cancel btn" href="#">Cancel</a>
                			</div>
                  		<div class="clearfix"></div>
                  		<?php echo Form::close(); ?>
               		
               		<label class="fieldlabel">Your total social media followers: <a href="#" class="info"><span class="right">This number should represent the total amount of followers you have on social media. Please be aware that lying about the amount of followers you have will get you banned from using our services.</span><ins class="fa fa-question-circle"></ins></a></label>
               		 <?php echo Form::open(
                  		[
                    		'route' => 'do_update_reach',
                    		'class' => 'do_update_reach reach-update'
                  		]
                		   ); ?>
                  		<select data-value="{{ $userSocial->reach }}" class="profile-reach-select" name="reach" data-id="{{\Sentry::getUser()->id}}">
                  			<option value="">Select number range</option>
                  			<option value="1-500" 	@if($userSocial->reach == "1-500") selected @endif>1-500</option>
                  			<option value="500-1K" 	@if($userSocial->reach == "500-1K") selected @endif>500-1K</option>
                  			<option value="1-5K" 	@if($userSocial->reach == "1-5K") selected @endif>1-5K</option>
                  			<option value="5-10K" 	@if($userSocial->reach == "5-10k") selected @endif>5-10k</option>
                  			<option value="10-50k" 	@if($userSocial->reach == "10-50k") selected @endif>10-50k</option>
                  			<option value="50-100k" 	@if($userSocial->reach == "50-100k") selected @endif>50-100k</option>
                  			<option value="100-500k" 	@if($userSocial->reach == "100-500k") selected @endif>100-500k</option>
                  			<option value="500K-1M" 	@if($userSocial->reach == "500K-1M") selected @endif>500K-1M</option>
                  			<option value="1-5M" @if($userSocial->reach == "1-5M") selected @endif>1-5M</option>
                  			<option value="5-10M" @if($userSocial->reach == "5-10M") selected @endif>5-10M</option>
                  			<option value="10M+" @if($userSocial->reach == "10M+") selected @endif>10M+</option>
                  			                  			
                  		</select>
                  		<div class="checker"></div>
                  		<div id="reach-actions" style="display: none; float: left; margin: 5px 0 0px 0;">
                  			<button class="btn btn-default btn-reach_save" data-attr="save" data-id="{{\Sentry::getUser()->id}}">Save</button>
                  			<a class="btn-reach_cancel btn" href="#">Cancel</a>
                			</div>
                  		<div class="clearfix" style="height: 12px;"></div>
                  		<?php echo Form::close(); ?>
               		
               		<label class="fieldlabel">Link your Social Media Accounts: <a href="#" class="info"><span class="right">Add your different social media accounts links to your Followback page. Linking a social media account that isn’t yours will get you banned from using our services.</span><ins class="fa fa-question-circle"></ins></a></label>
               	</div>
               </div>
               <div class="form-group social-media-input">
               	<div class="row">   
                  	<div class="col-sm-6 social-account" title="{{ $userSocial->twitter }}">	
                  	 <?php echo Form::open(
                  		[
                    		'route' => 'do_update_twitter',
                    		'class' => 'do_update_twitter social-update'
                  		]
                		   ); ?>
                  		<ins class="social-icon fa fa-twitter @if($userSocial->twitter != '') active @endif"></ins>
                  		<input type="text" data-gate="verify" data-id="{{\Sentry::getUser()->id}}" data-value="{{ $userSocial->twitter }}" autocomplete="off" value="{{ $userSocial->twitter }}" name="twitter" placeholder="twitter">
                  		<div class="social-confirm"><span>Save? <a href="#" class="social-yes">Yes</a> | <a href="#" class="social-cancel">Cancel</a></span></div>
                  		<div class="checker"></div><a href="#" class="social-save"><ins class="fa fa-floppy-o"></ins></a><?php echo Form::close(); ?>
                  	</div>
                  	<div class="col-sm-6 social-account"  title="{{ $userSocial->facebook }}">
                  	<?php echo Form::open(
                  		[
                    		'route' => 'do_update_facebook',
                    		'class' => 'do_update_facebook social-update'
                  		]
                		   ); ?>
                  		<ins class="social-icon fa fa-facebook @if($userSocial->facebook != '') active @endif"></ins>
                  		<input type="text" data-gate="verify" data-id="{{\Sentry::getUser()->id}}" data-value="{{ $userSocial->facebook }}" autocomplete="off" value="{{ $userSocial->facebook }}" name="facebook" placeholder="facebook">
                  		<div class="social-confirm"><span>Save? <a href="#" class="social-yes">Yes</a> | <a href="#" class="social-cancel">Cancel</a></span></div>
                  		<div class="checker"></div><a href="#" class="social-save"><ins class="fa fa-save"></ins></a>
                  		<?php echo Form::close(); ?>
                  	</div>
                	</div>
                	<div class="row">   
                  	<div class="col-sm-6 social-account"  title="{{ $userSocial->instagram }}">
                  	<?php echo Form::open(
                  		[
                    		'route' => 'do_update_instagram',
                    		'class' => 'do_update_instagram social-update'
                  		]
                		   ); ?>
                  		<ins class="social-icon fa fa-instagram @if($userSocial->instagram != '') active @endif"></ins>
                  		<input type="text" data-gate="verify" data-id="{{\Sentry::getUser()->id}}" data-value="{{ $userSocial->instagram }}" autocomplete="off" value="{{ $userSocial->instagram }}" name="instagram" placeholder="instagram">
                  		<div class="social-confirm"><span>Save? <a href="#" class="social-yes">Yes</a> | <a href="#" class="social-cancel">Cancel</a></span></div>
                  		<div class="checker"></div><a href="#" class="social-save"><ins class="fa fa-save"></ins></a>
                  		<?php echo Form::close(); ?>
                  	</div>
                  	<div class="col-sm-6 social-account"  title="{{ $userSocial->linkedin }}">
                  	<?php echo Form::open(
                  		[
                    		'route' => 'do_update_linkedin',
                    		'class' => 'do_update_linkedin social-update'
                  		]
                		   ); ?>
                  		<ins class="social-icon fa fa-linkedin @if($userSocial->linkedin != '') active @endif"></ins>
                  		<input type="text" data-gate="verify" data-id="{{\Sentry::getUser()->id}}" data-value="{{ $userSocial->linkedin }}" autocomplete="off" value="{{ $userSocial->linkedin }}" name="linkedin" placeholder="linkedin url">
                  		<div class="social-confirm"><span>Save? <a href="#" class="social-yes">Yes</a> | <a href="#" class="social-cancel">Cancel</a></span></div>
                  		<div class="checker"></div><a href="#" class="social-save"><ins class="fa fa-save"></ins></a>
                  		<?php echo Form::close(); ?>
                  	</div>
                	</div>
                	<div class="row">   
                  	<div class="col-sm-6 social-account" title="{{ $userSocial->soundcloud }}"  title="{{ $userSocial->soundcloud }}">
                  	<?php echo Form::open(
                  		[
                    		'route' => 'do_update_soundcloud',
                    		'class' => 'do_update_soundcloud social-update'
                  		]
                		   ); ?>
                  		<ins class="social-icon fa fa-soundcloud @if($userSocial->soundcloud != '') active @endif"></ins>
                  		<input type="text" data-gate="verify" data-id="{{\Sentry::getUser()->id}}" data-value="{{ $userSocial->soundcloud }}" autocomplete="off" value="{{ $userSocial->soundcloud }}" name="soundcloud" placeholder="soundcloud">
                  		<div class="social-confirm"><span>Save? <a href="#" class="social-yes">Yes</a> | <a href="#" class="social-cancel">Cancel</a></span></div>
                  		<div class="checker"></div><a href="#" class="social-save"><ins class="fa fa-save"></ins></a>
                  		<?php echo Form::close(); ?>
                  	</div>
                  	<div class="col-sm-6 social-account"  title="{{ $userSocial->youtube }}">
                  	<?php echo Form::open(
                  		[
                    		'route' => 'do_update_youtube',
                    		'class' => 'do_update_youtube social-update'
                  		]
                		   ); ?>                  	
                  		<ins class="social-icon fa fa-youtube @if($userSocial->youtube != '') active @endif"></ins>
                  		<input type="text" data-gate="verify" data-id="{{\Sentry::getUser()->id}}" data-value="{{ $userSocial->youtube }}" autocomplete="off" value="{{ $userSocial->youtube }}" name="youtube" placeholder="youtube">
                  		<div class="social-confirm"><span>Save? <a href="#" class="social-yes">Yes</a> | <a href="#" class="social-cancel">Cancel</a></span></div>
                  		<div class="checker"></div><a href="#" class="social-save"><ins class="fa fa-save"></ins></a>
                  		<?php echo Form::close(); ?>
                  	</div>
                	</div>                	
                 	<div class="row">   
                  	<div class="col-sm-6 social-account"  title="{{ $userSocial->googleplus }}">
                  	<?php echo Form::open(
                  		[
                    		'route' => 'do_update_googleplus',
                    		'class' => 'do_update_googleplus social-update'
                  		]
                		   ); ?>                   	
                  		<ins class="social-icon fa fa-google-plus @if($userSocial->googleplus != '') active @endif"></ins>
                  		<input type="text" data-gate="verify" data-id="{{\Sentry::getUser()->id}}" data-value="{{ $userSocial->googleplus }}" autocomplete="off" value="{{ $userSocial->googleplus }}" name="googleplus" placeholder="google+ url">
                  		<div class="social-confirm"><span>Save? <a href="#" class="social-yes">Yes</a> | <a href="#" class="social-cancel">Cancel</a></span></div>
                  		<div class="checker"></div><a href="#" class="social-save"><ins class="fa fa-save"></ins></a>
                  		<?php echo Form::close(); ?>
                  	</div>
                  	<div class="col-sm-6 social-account"  title="{{ $userSocial->web }}">
                  	<?php echo Form::open(
                  		[
                    		'route' => 'do_update_web',
                    		'class' => 'do_update_web social-update'
                  		]
                		   ); ?>  
                  		<ins class="social-icon fa fa-link @if($userSocial->web != '') active @endif"></ins>
                  		<input type="text" data-gate="verify" data-id="{{\Sentry::getUser()->id}}" data-value="{{ $userSocial->web }}" autocomplete="off" value="{{ $userSocial->web }}" name="web" placeholder="website url">
                  		<div class="social-confirm"><span>Save? <a href="#" class="social-yes">Yes</a> | <a href="#" class="social-cancel">Cancel</a></span></div>
                  		<div class="checker"></div><a href="#" class="social-save"><ins class="fa fa-save"></ins></a>
                  		<?php echo Form::close(); ?>
                  	</div>
                	</div>               	
					</div>
					
					@else
					
						<hr>
								
               @endif
                <?php echo Form::open(['route' => ['do_reset_password']]); ?>
                <div class="form-group">
                  <label for="password" style="margin-bottom: 0px;"  class="fieldlabel">Change Password</label>
                  <input name="current_password" type="password" class="form-control" placeholder="Current Password">
                  <input name="password" type="password" class="form-control" placeholder="New Password">

                  <div class="row">
                    <div class="col-md-8">
                      <input name="password_confirmation" type="password" class="form-control" placeholder="Re-type New Password">
                    </div>
                    <div class="col-md-4 row-nopaddingleft">
                      <button type="submit" class="button btn-reset">Reset</button>
                    </div>
                  </div>
                </div>
                <?php echo Form::close(); ?>
                <div class="clearfix" style="height: 30px;"></div>
              </div>
            </div>
          </div>
      </div>
      
      <div id="blocked-tab" style="display: none;">
      
     
       
          <div class="account-content">
            <h4>Blocked Users</h4>
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
                      <td>
                        <a href="{{route('unblock_bids', $user->id)}}" class="btn btn-default">Unblock</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @else
              <p class="block-user-msg" style="text-align: center; width: 100%; margin: 0 auto; font-weight:bold;">You have not blocked any users yet.</p>
            @endif
          </div>
      
      	 <div class="clearfix" style="height: 30px;"></div>
      
      </div>    
          
          
        </div>
      </div>
    </div>

    {{-- End NEW Template --}}
    {{--<div id="connect">
      <div class="container">
        <div class="row connect-container">
          <div class="container payment-container">
            <div class="account-content">


              <div class="final-payments">
                <h4>Payments</h4>

                <div class="final-bid">
                  <div class="bid-col">
                    <h1>${{ $bids['receive_bids'] }}</h1>
                    <h4>received bids</h4>
                  </div>
                  <div class="bid-col">
                    <h1>${{ $bids['accepted_bids'] }}</h1>
                    <h4>accepted bids</h4>
                  </div>
                  <div class="bid-col">
                    <h1>${{ $bids['sent_bids'] }}</h1>
                    <h4>sent Bids</h4>
                  </div>
                  <div class="bid-col active">
                    <h1>$0</h1>
                    <h4>DONATED TO CHARITY</h4>
                  </div>
                </div>
              </div>

              <div class="payment-works">
                <h4>How Payments Works</h4>

                <div class="payment-cols">
                  <div class="row">
                    <div class="col-md-6 payment-col">
                      <ins class="fa fa-tasks"></ins>
                      <p style="text-align: left;">1. Once you accept a social task, you have 24 hours to complete it. That social tasks must be continuously upheld for a minimum of thirty days in order to be credited with the completion of the social task. Any social task that is not honored by this policy will be issued a refund.</p>
                    </div>
                    <div class="col-md-6 payment-col">
                      <ins class="fa fa-calendar"></ins>
                      <p style="text-align: left;">Payments are sent on the 15th and 30th of each month. Individuals that receive higher than average volume of social tasks can request immediate Paypal payment or bank transfers at
                        <a href="mailto:Request@followback.com?subject=Request Payment" style="color: #0100fb;">Request@followback.com</a>. Make sure to add your Paypal email address which is located above.
                        <a href="#" class="popup-link" style="color: #0100fb;">Learn More</a>
                      </p>
                    </div>

                  </div>
                </div>
              </div>

              <div class="clearfix" style="height: 30px;"></div>

            </div>
          </div>


        </div>
      </div>
    </div>--}}
  </div>
 

  <?php $user = \Sentry::getUser(); ?>
  <div class="row hidden">
    <div class="col-xs-12">
      <h1>Social Media Accounts</h1>
      <?php $social_icons = Config::get('conservices'); ?>
      <ul class="list-group">
        @if(!empty($social_icons))
          @foreach($social_icons as $social_icon)
            <?php
            $name = $social_icon['name'];
            $identifier = $social_icon['identifier'];
            $route = $social_icon['route'];
            $class_name = $social_icon['class_name'];
            $icon = $social_icon['icon_name'];
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
  {{asset_javascript('plugins/jquery.fileapi.min.js')}}
  {{asset_javascript('app/profileImageUpload.min.js')}}

  <style>
	
    .profile-row {
      width: 100%;
      max-width: 1100px;
      margin: 0 auto;
      padding: 30px 0 25px;
      border-top: 1px solid #CDCDCD;
    }

    .profile-row LABEL {
      font-weight: 600;
      font-size: 18px;
      color: #999;
    }

    .profile-row A {
      color: #0100fb;
    }

    .profile-row A:HOVER {
      color: #000;
    }

    .profile-row .column1 {
      float: left;
      width: 50%;
    }

    .profile-row .column2 {
      float: left;
      width: 50%;
      text-align: right;
    }

    .notification-on,
    .notification-off {
      font-size: 20px;
    }

    .notification-on {
      display: block;
      color: green;
    }

    .notification-on.off {
      display: none;
    }

    .notification-off {
      display: none;
    }

    .notification-off.off {
      display: block;
    }

    #bidUpload {
      text-align: center;
      right: -45px;
    }

    .profile-pic {
      margin: 0 auto;
      width: 140px;
      position: relative;
      display: inline-block;
    }

    #theImg {
      width: 140px;
      height: 140px !important;
      margin: 0 auto 25px auto;
      border-radius: 100px;
    }
    
    #name-actions, #email-actions, #username-actions, #paypal-actions { padding: 0 !important; margin: -10px 0 15px 0 !important; }
    .form-group label[for=name],
    .form-group label[for=email] { margin: 0 0 5px 0; }
    
   @media only screen and (max-width: 1199px) {
   
   	#bidUpload.profile-upload { margin-right: 20px; }
   
   }
   
   @media only screen and (max-width: 991px) {
   	#bidUpload.profile-upload { clear: both; float: left; margin: 0px !important;  left: 0px !important; }
   	.update-name { margin-top: 120px; }
  	}
    
    
  </style>

  <script>
    $(window).load(function () {

      $(".display-update-email").click(function () {
        $(".edit-profile-email-button").click();
        return false;
      });

      $(".ChangePass").click(function () {
        $(".hidden-password").fadeIn();
        return false;
      });

      $(".notification-checkbox").click(function () {
        $(".SaveNotificationBtn").show();
        return true;
      });

      $(".SaveNotificationBtn").click(function () {
        $(".SaveNotification").click();
        return false;
      });

      /* Change Email */
      $("#email-input").focusin(function () {
        $("#email-actions").fadeIn();
        return false;
      });

      $(".btn-change_email_cancel").click(function () {
        $("#email-actions").fadeOut();
        return false;
      });

      /* Change Name */
      $("#name-input").focusin(function () {
        $("#name-actions").fadeIn();
        return false;
      });
      
      $(".btn-change_name_cancel").click(function () {
        $("#name-actions").fadeOut();
        return false;
      });
      
      /* Change Username */
      $("#username-input").focusin(function () {
        $("#username-actions").fadeIn();
        return false;
      });
      
      $(".btn-change_username_cancel").click(function () {
        $("#username-actions").fadeOut();
        return false;
      });

      /* Change Paypal */
      $("#paypal-input").focusin(function () {
        $("#paypal-actions").fadeIn();
        return false;
      });
      
      $(".btn-change_paypal_email").click(function () {
        $(".change-paypal").addClass("on");
      });

      $(".btn-change_paypal_cancel").click(function () {
        $(".change-paypal").removeClass("on");
        $(".btn-change_paypal_email").fadeIn();
        $("#paypal-actions").hide();
        return false;
      });

      $(".toggle").click(function () {

        setTimeout(function () {
          var value = $('input[name="notifications"]').get(0).checked;
          $(".notification-input").val(value == 1 ? 0 : 2);
          $(".do_change_notification").submit();
        }, 1000);
        return;
      });

      $(".btn-password_reset").click(function () {
        $(".reset_password").submit();
        return false;
      });

      $("#wrapper").css("padding-bottom", "0");

    });
  </script>

@stop