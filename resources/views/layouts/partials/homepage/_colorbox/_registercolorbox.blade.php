<div class="register-content">

	<div class="loader-contain">
		<div class="search-loader"></div>
	</div>
	<div class="row container login-container" style="width:100%;">

		<div class="register-form-box col-md-4" style="padding:0px;width:100%;">
			<!-- <h3 style="text-align:center"> -->
				<!-- {{ HTML::image('assets/images/homepage/logo/logo.png', $alt="", $attributes = array()) }} -->
			<!-- </h3> -->
			@if(!Sentry::check())
				<p style="color: #0100fb; text-align:center;margin-bottom:20px;font-size:24px;">Sign up</p>
				<p class="error-email-address alert-danger"></p>
				<p class="error-email-address-user alert-danger" style="font-size: 12px;"></p>
				<!-- <p class="auth-success-message alert-success"></p> -->

			   <?php echo Form::open([
			    	'route'=>'do_register',
			    	'id'=>'register-form-box'
			    	]); ?>

				 {{ csrf_field() }}

				<?php echo Form::field([
						'name' => 'email',
						'class' => 'custom-form-input user-image5',
						'placeholder' => 'Enter your email',
						'value' => isset($socialUser['email']) ? $socialUser['email'] : null,

						]); ?>

					<!-- <label class="control-label" for="username">Username</label> -->
					<div class="input-group email-input" style="margin-bottom:15px;width:100%;position:relative;">


						<div class="email-image email-image-focus" style="position:absolute;width:45px;height:30px;top:2px;left:2px;cursor:text;"></div>
						<div class="input-group-addon email-image-focus email-image-label" style="position:absolute;width:auto;padding-right:0;height:30px;top:2px;left:1px;border:none;padding-top:9px;cursor:text;margin-left:33px;background-color:#fff;" id="basic-addon2">{{ Config::get('otherconstants')['USERNAME_URL'].'/' }}</div>
						<input style="border-radius:4px 0 0 4px;" name="username" type="text" class="email-image-input form-control" placeholder="Create a username" aria-describedby="basic-addon2">

					</div>

				<!-- 	<?php echo Form::field([
						'name' => 'username',
						'label' => 'Username',
						'placeholder' => true,
						]); ?> -->

				<?php echo Form::field([
						'name' => 'password',
						'class' => 'custom-form-input password-image',
						'placeholder' => 'Create a password',
						'type' => 'password',

						]); ?>



					<button class="btn btn-blue register-content-submit-btn">Sign up</button>
					<p style="text-align:center;font-size:14px;" class="term-condition">By signing up, I agree to Followback's <br><a class="blue-effect" href="/terms-of-service" style="font-weight: bold;">Terms of Service</a> and <a class="blue-effect" href="/privacy-policy" style="font-weight: bold;">Privacy Policy.</a></p>

					<p style="text-align:center;font-size:14px;" class="acc">Already have a Followback account?
						<a class='login-form-colorbox blue-effect' href="#" style="font-weight: bold;"><span>Log In</span></a>


					</p>

				<?php echo Form::close(); ?>
			@else
				<p style="text-align:center;padding-top:20px;">You've already signed in with followback.</p>
			@endif

		</div>

		<div class="register-image-box col-md-4" style="padding:15px 0;width:100%;display:none;">
			<?php echo Form::open(['route' => ['save_reg_profile_image'], 'class' => 'save-reg-profile-img-form']); ?>
			<div style="text-align:center;margin-bottom:20px;font-size:14px;">
				<p style="margin-bottom:5px;">Hi <span class="display-username"></span>, welcome to Followback!</p>
				<p>You're account is now ready, please upload your photo:</p>
				</div>

				<div class="reg-profile-image-container">
					<img style="height:140px; width:140px; border-radius:50%;" src="/assets/images/homepage/default-user.png" alt="Followback">
					<div class="register-loader-contain" style="background:transparent;z-index:9999;positions:absolute">
				        <div class="reg-img-search-loader"></div>
				    </div>
				</div>
				<p style="text-align:center;"><span class="display-username"></span></p>

				<div class="col-md-12 right-col js-fileapi-wrapper btn-large upload-image" id="regProfileUpload" style="padding:0px;display:block;">

	                <div class="js-browse" style="text-align:center;">
	                    <input class="click-pic custom-browse-button btn btn-blue" title="Add profile photo" type="file" name="file">
	                </div>

	            </div>

				<p style="text-align:left;margin-bottom:0;">
				<button style="float:right;font-size:13px;margin-top:1px;" class="reg-done-process grey-effect">Save</button>
				<?php
					/*
					<a style="font-size:13px;" class="skip-register-image-box grey-effect">Skip</a>
					<button style="float:right;font-size:13px;margin-top:1px;" class="save-reg-profile-img-btn button-normal grey-effect">Next</button>
					*/
				?>
				</p>
				<input type="hidden" name="avatar" value="{{ Config::get('otherconstants')['FOLLOWBACK_DEFAULT_IMAGE'] }}">
			<?php echo Form::close(); ?>
		</div>

<?php /*
		<div class="row container bottom-section register-sync-acc-box" style="display:none;">
			<div class="connected">
				Sync your accounts to receive your bids from other platforms.
			</div>

			<div class="social-btn text-center" style="margin-bottom:20px;">
				<?php $social_icons = Config::get('conservices'); ?>

				@if(!empty($social_icons))

					@foreach($social_icons as $social_icon)
						@if($social_icon['display_flag'])
							<?php
							$name  =  $social_icon['name'];
							$identifier  =  $social_icon['identifier'];
							$route_connect =  $social_icon['auth_connect_route'];
							$class_name =  $social_icon['class_name'];
							$icon       =  $social_icon['icon_name'];
							?>

							<a href="{{route($route_connect ,['type' => $identifier])}}" target="_blank">
								<div class="btn-group">
									<button class="btn <?php echo $class_name; ?> <?php echo $identifier.'-colorbox'; ?> social-media-buttons" id="<?php echo 'onclick-'.$identifier; ?>">

										<i class="fa <?php echo $icon; ?>"></i>

										<span class="join-social-button-name"><?php echo $name; ?></span>
									</button>
								</div>
							</a>
						@endif
					@endforeach
				@endif
			</div>
			<p class"skip" style="margin-bottom:10px;overflow:auto;">
				<!-- <a style="font-size:13px;" class="skip-register-sync-acc-box">Skip</a> -->
				<button style="float:right;font-size:13px;margin-top:1px;padding:0;" class="reg-done-process button-normal grey-effect">Done</button>
			</p>
		</div>
*/
?>


	</div>
</div>
@section('js_include')
	{{asset_javascript('plugins/jquery.fileapi.min.js')}}
	{{asset_javascript('app/register-image-upload.js')}}
@stop
