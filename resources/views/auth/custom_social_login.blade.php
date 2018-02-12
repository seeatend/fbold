@extends('layouts.vine')
@section('content')
  <div class="container">
    <div class="row">

      <div class="col-md-12 followback-form-top-margin">


        <div class="vine-login-content" style="">

          <div class="loader-contain">
            <div class="search-loader"></div>
          </div>

          <div class="login-container" style="width:100%">

            <div class="col-custom-md-4">
              <div style="">
                <?php echo HTML::image(
                  'assets/images/icons/vine-for-login.jpg',
                  $alt = "",
                  $attributes = array('height' => '80')
                ); ?>

              </div>
              <p style="text-align:center;margin-bottom:15px;">Please sign into your Vine account.</p>
              <!-- <p class="vine-fail-error"></p> -->
              <!-- <button class="twitter-signin-button" data-ember-action="2361">Sign in with Twitter</button>
                <p style="text-align:center;">or</p> -->

              @if(Session::has('error-message'))
                <p class="alert alert-danger">
                  {{ Session::get('error-message') }}
                </p>
              @endif

             <?php echo Form::open([
                'route'=>'do_custom_social_vine_login',
                'class'=>'vine-login-form-box'
                ]);
              ?>

             <?php echo Form::field([
                'name' =>'email',
                'placeholder' => 'Email',
                'class' => 'custom-form-input vine-input'
              ]); ?>

             <?php echo Form::field([
                'name' =>'password',
                'placeholder' => 'Password',
                'type' => 'password',
                'class' => 'custom-form-input vine-input'
              ]); ?>


              <div class="vine-submit-btn-container">
                <!-- <a href="{{route('remind_password')}}">Forgot your password?</a> -->
                <button class="vine-login-submit-btn custom-vine-submit-btn">Sign In</button>
              </div>
              <?php echo Form::close(); ?>

              <div style="clear:both; margin-top:30px;" class="pull-right">
                <a href="{{route('index')}}">
                  Back to Followback
                </a>
              </div>

            </div>

          </div>
          <!-- <div class="row mt5">
		<div class="col-md-7 text-center login-remind-password" style="margin-left:160px;">
			<a href="{{route('remind_password')}}"> Forgot your password?</a>
		</div>
	</div> -->
        </div>


      </div>
    </div>
  </div>
@stop