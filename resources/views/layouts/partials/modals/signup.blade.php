<div id="SignUpModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="box_close">
		    <span>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
		    </span>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-center">
            <a class="main_logo" href="#">&nbsp;</a>
          </div>
     
          <div class="col-md-12">

            <p class="error-email-address alert-danger" style="font-size: 12px;"></p>
            <p class="error-email-address-user alert-danger" style="font-size: 12px;"></p>

            <?php echo Form::open(
              [
                'route' => 'do_register',
                'id' => 'sign_up'
              ]
            ); ?>

            {{ csrf_field() }}
				<div style="position: relative;">
				<a href="#" class="info" style="position: absolute; right: 10px; top: 10px;"><span class="right">Enter the email address you want linked to your Followback account. You can always change it later in settings.</span><ins class="fa fa-question-circle"></ins></a>
				
            <?php echo Form::field(
              [
                'name' => 'email',
                'class' => '',
                'type' => 'email',
                'placeholder' => 'Enter your email',
                'value' => isset($socialUser['email']) ? $socialUser['email'] :
                  null,

              ]
            ); ?>
            </div>
				<div style="position: relative;">
				
				<div class="form-group">
					<a href="#" class="info" style="position: absolute; right: 10px; top: 10px;"><span class="right">The username you choose should either be your actual name or what you go by on social media. The name chosen will be how users will find you.</span><ins class="fa fa-question-circle"></ins></a>
				<input name="username" class="form-control username-input" size="18" maxlength="18" placeholder='Create a username'>
           	</div>
           	</div>
           	
            <?php
				/*
					echo Form::field(
              [
                'name' => 'username',
                'class' => 'username-input',
                'size' => '18',
                'maxlength' => '18',
                'placeholder' => 'Create a username'

              ]
            );
            */
             ?>

            <div class="input-group-addon username-focus username-label" style="position:absolute;width:auto;padding-right:0;height:30px;top:4px;left:1px;border:none;padding-top:9px;cursor:text;margin-left:2px;background-color:transparent;" id="basic-addon2">{{ Config::get('otherconstants')['USERNAME_URL'].'/' }}</div>

            <?php echo Form::field(
              [
                'name' => 'password',
                'class' => '',
                'placeholder' => 'Create password',
                'type' => 'password',

              ]
            ); ?>
            <button type="submit" class="btn btn-block btn-primary">Sign up</button>
            </form>
            
         <div class="col-md-12 text-center login_sign_up_title">
          	
          	Already have an account?
            <a class="ModalLogin" style="text-decoration: underline;" href="#" data-toggle="modal" data-target="#LoginModal">Log in</a>
         
          </div>
            
            {{--<p class="login_sign_up_optional">Or sign up using...</p>

            <div class="row social_networks_auth">
              <div class="col-xs-4 col-sm-4 col-md-4 text-center desktop_semi_padding_right">
                <a class="twitter_login" href="#"><i class="fa fa-twitter"></i></a>
              </div>
              <div class="col-xs-4 col-sm-4 col-md-4 text-center desktop_semi_padding">
                <a class="facebook_login" href="#"><i class="fa fa-facebook"></i></a>
              </div>
              <div class="col-xs-4 col-sm-4 col-md-4 text-center desktop_semi_padding_left">
                <a class="instagram_login" href="#"><i class="fa fa-instagram"></i></a>
              </div>
            </div>--}}
          </div>
          <div class="col-md-12 text-center">
            <p id="sign_up_footer" class="second_color">By signing up, I agree to Followback's<br/>
              <a href="/terms-of-service">Terms of service</a> and
              <a href="/privacy-policy">Privacy Policy</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>