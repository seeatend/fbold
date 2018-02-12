<div class="login-content">

  <div class="loader-contain">
    <div class="search-loader"></div>
  </div>

  <!-- <div class="row container bottom-section">
			<div class="connected">
				Sign in with
			</div>

			<div class="social-btn text-center">
				<?php $social_icons = Config::get('conservices'); ?>

  @if(!empty($social_icons))
  @foreach($social_icons as $social_icon)
  <?php
  $name = $social_icon['name'];
  $identifier = $social_icon['identifier'];
  $route = $social_icon['route'];
  $class_name = $social_icon['class_name'];
  $icon = $social_icon['icon_name'];
  ?>

    <a href="{{route($route ,['type' => $identifier])}}">
					<div class="btn-group">
						<button class="btn <?php echo $class_name; ?> <?php echo $identifier .
    '-colorbox'; ?> social-media-buttons" id="<?php echo 'onclick-' .
    $identifier; ?>">

							<i class="fa <?php echo $icon; ?>"></i>

							<span class="join-social-button-name"><?php echo $name; ?></span>
						</button>
					</div>
				</a>
				@endforeach
  @endif
    </div>
  </div>






      <div class="or">OR</div> -->


  <div class="row container login-container" style="width:100%">

    <div class="col-md-4" style="padding:0px;width:100%;margin:auto;float:none;">
      <!-- <h3 style="text-align:center">

      </h3> -->
      <p class="form-login-heading" style="color: #0100fb; text-align:center;margin-bottom:20px;font-size:24px;">Log in</p>

      <p class="auth-success-message alert-success"></p>

      <p class="auth-fail-error alert-danger" style="font-size:12px;"></p>
      <?php echo Form::open(
        [
          'route' => 'do_auth_login',
          'id' => 'login-form-box'
        ]
      ); ?>

      {{ csrf_field() }}

      <?php echo Form::field(
        [
          'name' => 'email',
          'placeholder' => 'Email or username',
          'class' => 'custom-form-input email-image'
        ]
      ); ?>
      <?php echo Form::field(
        [
          'name' => 'password',
          'placeholder' => 'Password',
          'type' => 'password',
          'class' => 'custom-form-input password-image'
        ]
      ); ?>

      <button class="btn btn-blue followback-submit-btn" style="margin-bottom: 10px;">Log in</button>

      <div class="remember-section col-md-12" style="margin-top: 0;width:100%;padding:0;">
        <p class="col-md-6" style="padding:0;width:50%;float:left;">
          <input name="remember" id="checkboxG3" class="css-checkbox" type="checkbox"><label for="checkboxG3" class="css-label" style="color: #0100fb; font-weight: normal;">Remember me</label>
        </p>

        <p class="full-line col-md-6" style="padding:0;text-align:right;width:50%;float:left;margin-top:2px;">
          <a class="blue-effect" href="{{route('remind_password')}}" style="color: #0100fb; font-weight: normal;"> Forgot your password?</a>
        </p>
      </div>

      <p style="text-align:center;font-size:14px;" class="acc">Don't have an account?
        <a class="blue-effect register-form-colorbox cboxElement" style="color: #0100fb; font-weight: bold;" href="#">Sign up</a>
      </p>
      <!-- <div class="row">
						<div class="col-md-12" style="clear:both;">
							<p class="full-line"><a href="{{route('remind_password')}}"> Forgot your password?</a><a href="" style="margin-left:12px;">Terms and Services</a></p>
						</div>
					</div> -->

      <?php echo Form::close(); ?>
    </div>
  </div>
  <!-- <div class="row mt5">
		<div class="col-md-7 text-center login-remind-password" style="margin-left:160px;margin-top:-20px;">
			<a href="{{route('remind_password')}}"> Forgot your password?</a>
		</div>
	</div> -->
</div>
