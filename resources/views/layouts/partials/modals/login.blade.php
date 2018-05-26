<div id="LoginModal" class="modal fade" role="dialog">
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
            <p class="auth-success-message alert-success"></p>
            <p class="auth-fail-error alert-danger" style="font-size: 12px"></p>
            <?php echo Form::open(
              [
                'route' => 'do_auth_login',
                'id' => 'login'
              ]
            ); ?>

            {{ csrf_field() }}

            <?php echo Form::field(
              [
                'name' => 'email',
                'placeholder' => 'Email or username',
                'class' => ''
              ]
            ); ?>

              <?php echo Form::field(
              [
                'name' => 'password',
                'placeholder' => 'Password',
                'type' => 'password',
                'class' => ''
              ]
            ); ?>

            <div class="form-group login14px">
              <div class="row">
                <div class="col-md-6 login-col-left" style="float: left;">
                  <div class="checkbox checkbox_modal">
                    <input name="remember" id="remember_me" class="styled" type="checkbox">
                    <label for="remember_me">
                      Remember Me
                    </label>
                  </div>
                </div>
                <div class="col-md-6 login-col-right"  style="float: right;">
                 <label><a href="{{route('remind_password')}}">Forgot Password?</a></label>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-block btn-primary followback-submit-btn">Log in</button>
            
         
            <?php echo Form::close(); ?>
            
             <div class="col-md-12 text-center login_sign_up_title">
            No account yet?
            <a class="ModalSignup" style="text-decoration: underline;" href="#" data-toggle="modal" data-target="#SignUpModal">Sign up</a>
          </div>
            
            {{--<p class="login_sign_up_optional">Or log in using...</p>

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
        </div>
      </div>
    </div>
  </div>
</div>