<?php
	$description = "Get " . $username . " to do a Social Media Task on Followback.";
	$keywords = "tweet,pin,like,post,bid,price,media,comment," . $result['data']['username'] . "," . "follow,social,back,social,task,info";
	$avatar = $result['data']['avatar'];
	$body_class = "PageSocialTask bg-white";
?>

@extends('layouts.simple')
@section('content')
  <div id="socialtask" class="wrapper">
    <div class="row">
      <div class="col-md-12">
        <?php echo Form::open(
          [
            'route' => ['bid_make', $service, $identifier],
            'class' => 'bv-form create-bid-form'
          ]
        ); ?>
      
        <div class="row" id="profile_top_block">
          <div class="col-md-12">
            <div class="row">
              <div id="profile_photo">
              	
              	 @if(isset($result['data']) && !empty($result['data']))
                  <?php 
                  
                  	$image = !empty($result['data']['avatar']) ? $result['data']['avatar'] : '/assets/images/homepage/facebook-avatar.png'; 
                    	$realname = !empty($result['data']['name']) ? $result['data']['name'] :  $result['data']['username']; 
                    
                  ?>
                @endif
              	
              		<span class="avatar-circle" style="background: url({{ $image }}) center no-repeat; background-size: cover;" >
              			
              			<img src="/assets/images/placeholder-avatar.png" alt="{{ $realname }} Avatar">
                
                	</span>
              </div>
              <div id="profile_top_data">
               	<h1 class="profile-name">
               		<span>
               		{{ $realname }} 
               		@if ((int) $verfied === 1)
               		<a class="profile_verified" href="#"></a>
               		@endif
               		</span>
                	</h1>
                	
                	@if(isset($userSocial->about))
               	<p class="profile-about">{{$userSocial->about}}</p>
	            @endif
                <?php if(isset($userSocial)){ ?>
                <ul class="profile-social">
						 
						 
						 
						 @if(isset($userSocial->reach))<li class="profile-reach">{{$userSocial->reach}} Followers &nbsp;
						 
						 	 @if($userSocial->twitter != "" || $userSocial->facebook != "" || $userSocial->instagram != "" || $userSocial->googleplus != "" || $userSocial->linkedin != "" || $userSocial->youtube != "" || $userSocial->soundcloud != "" || $userSocial->web)
						 		<span style="color: #ccc;">|</span>&nbsp;
						 	@endif
						 
						 </li>@endif
						 @if($userSocial->twitter != "")<li><a target="_blank" href="{{$userSocial->twitter}}"><ins class="fa fa-twitter"></ins></a></li>@endif
						 @if($userSocial->facebook != "")<li><a target="_blank" href="{{$userSocial->facebook}}"><ins class="fa fa-facebook"></ins></a></li>@endif
						 @if($userSocial->instagram != "")<li><a target="_blank" href="{{$userSocial->instagram}}"><ins class="fa fa-instagram"></ins></a></li>@endif
						 @if($userSocial->googleplus != "")<li><a target="_blank" href="{{$userSocial->googleplus}}"><ins class="fa fa-google-plus"></ins></a></li>@endif
						 @if($userSocial->linkedin != "")<li><a target="_blank" href="{{$userSocial->linkedin}}"><ins class="fa fa-linkedin"></ins></a></li>@endif
						 @if($userSocial->youtube != "")<li><a target="_blank" href="{{$userSocial->youtube}}"><ins class="fa fa-youtube"></ins></a></li>@endif
						 @if($userSocial->soundcloud != "")<li><a target="_blank" href="{{$userSocial->soundcloud}}"><ins class="fa fa-soundcloud"></ins></a></li>@endif
						 @if($userSocial->web != "")<li><a target="_blank" href="{{$userSocial->web}}"><ins class="fa fa-link"></ins></a></li>@endif
					 </ul>
					  <?php }; ?>
				
	            </div>
            
            </div>
          </div>
        </div>
        
        <?php echo Form::field(
              [
                'type' => 'select',
                'options' => [],
                'name' => 'service_type',
                'label' => false,
                'autofocus' => 'autofocus',
                'params' => 'id:service_type',
                'class' => "select onchangeType hide",
                'div' => false,
              ]
            ); ?>
        <div class="row">
          <div class="col-md-12" id="profile_get_to_block">
          <div class="clearfix" style="height: 2px;"></div>
          <h5 class="socialtask-message">Get {{ $result['data']['username'] }} to</h5>
            <div class="clearfix" style="height: 15px;"></div>
          </div>
          
		  {{-- SOCIAL TASK OPTIONS --}} 
		  <div class="col-md-12">
			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs hidden-sm hidden-xs" role="tablist">
				 <li role="presentation" class="active">
					<a class="type-tab actionFollowback" href="#follow" aria-controls="follow" role="tab" data-value="follow_back">Followback</a>
				 </li>
				  <li role="presentation">
					<a class="type-tab actionLike" href="#like" aria-controls="like" role="tab" data-value="like">Like</a>
				 </li>
				 <li role="presentation">
					<a class="type-tab actionPost" href="#share" aria-controls="share" role="tab" data-value="post_media">Post&nbsp;media</a>
				 </li>
				 <li role="presentation">
					<a class="type-tab actionPostText" href="#post" aria-controls="post" role="tab" data-value="post_text">Post&nbsp;text</a>
				 </li>
				  <li role="presentation">
					<a class="type-tab actionComment" href="#comment" aria-controls="comment" role="tab" data-value="comment">Comment&nbsp;on</a>
				 </li>
			  </ul>
			  <select class="hidden-md hidden-lg" id="mobile_profileTabs">
				 <option value='follow_back'>Followback</option>
				 <option value='like'>Like</option>              
				 <option value='post_media'>Post Media</option>       
				 <option value='post_text'>Post Text</option>
				 <option value='comment'>Comment On</option>
			  </select>
			</div>
        </div>
        <div class="row">
          <div class="col-md-12">

            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active">

             
                    @if (count($errors) > 0)
                      <div class="alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif
                    <div class="form-group socialtask-price">
                      <label for="offer-price">Enter the amount you are willing to pay to get this social media task done:</label>
                      <!-- Bid Price Field -->
                      <input type="text" pattern="\d*" id="offer-price" name="offer_price" class="form-control offer-price" placeholder="Starting Bid">
                    </div>
                 

                <div class="profile-box">

                  <div class="followback-container-box">

                    <div class="comment-container">

                      <div id="FileLoader" class="col-md-12 main-upload-area" style="margin-bottom: 15px;">
                        {{-- JAVASCRIPT WILL LOAD THE INFO HERE --}}
                      </div>

                      <div class="profile-textarea" id="profile-textarea">
                        <div class="display-instruction" style="margin-top: 0px; padding-top: 0px; max-width: 100%; width: 100%;">
                        {{-- 
                        	JAVASCRIPT WILL LOAD INFO HERE 
                        	Uses BidController@get-instructions
                        	/bid/instructions/followback
                        
                        --}}
                        </div>
                        <textarea style='clear: both;' id="profile-message" class="form-control profile-textarea" name="comment" cols="1" rows="1" placeholder="Enter the page or public username you want followed" spellcheck="false"></textarea>
                      </div>

                      <span class="js-name"></span>

                      <div class="clearfix"></div>
                    </div>

                    <input type="hidden" name="service" value="{{$service}}">
                    <input type="hidden" name="identifier" value="{{$identifier}}">
                    <input type="hidden" name="avatar" value="{{isset($result['data']['avatar']) ? $result['data']['avatar'] : ''}}">
                    <input type="hidden" name="username" value="{{isset($result['data']['username']) ? $result['data']['username'] : ''}}">
                    <input type="hidden" name="url" value="{{ $result['data']['url'] }}">
						<div class="clearfix" style="height: 19px;"></div>
							 <div class="con">
                  @if(\Sentry::check())
                   <input type="hidden" name="is_login" id="is_login" value="login">

                   <button type="submit" class="submit social-task-submit create-bid-continue upload-disable-btn">Continue</button>
  
                  @else
                   <input type="hidden" name="is_login" id="is_login" value="not_login">
                    <a class="social-task-submit"  data-toggle="modal" data-backdrop="true" data-target="#LoginModal" href="#">Continue</a>

                  @endif  
                    <div class="clearfix" style="height: 50px;"></div>
                  </div>
                  </div>

                </div>

                <div class="form-group"></div>
                <div class="row">
                 
                </div>

              </div>

            </div>

          </div>
        </div>
         <?php echo Form::close(); ?>
      </div>
      <span class="get-bid-instruction" data-url="{{ route('get_instruction') }}" data-username="{{ $result['data']['username'] }}"></span>
     
    </div>
  </div>


  <!-- /new section -->

  <div id="profile" style="opacity: 0; float: left; height: 1px; width: 1px; overflow: hidden;">
    <div class="container">
      <div class="upper-container">

      </div>

      @if(isset($result['data']) && !empty($result['data']))


        <div class="profile-search-container">
          <span class="hold-min-price-url" style="display:none;">
            {{route('min_bid_price', array('service'=> $service, 'identifier' => $identifier))}}
          </span>

          <div class="profile-search-box" id="profile-network" style="display:none;">

            <?php echo Form::open(
              [
                'route' => 'search_users_without_auth',
                'method' => 'GET',
                'class' => 'form-search-users stop-submit temp-add-class'
              ]
            ); ?>

            <div class="form-group ui-widget ui-widget-content ui-widgets profile-followback-search" id="socialtaskcontent" style="width:450px;float:left;border:none;">

              <input name="search_profile_input_field" class="input-profile-search-text ui-autocomplete-input form-control" id="search-profile-input" type="text" placeholder="Search for the Username you want followback" style="width:380px;border:1px solid #ccc;float:left">

              <div class="profile-page-bottom-search flat-btn">
                <?php echo HTML::image(
                  'assets/images/icons/instagram-32x32-icon.png',
                  $alt = "",
                  $attributes = array('height' => '16', 'width' => '16')
                ); ?>
                instagram
              </div>
              <div class="loader-contain-profile" style="background:transparent;z-index:9999;positions:absolute;">
                <div class="search-profile-loader"></div>
              </div>

              <div class="focusout-loader-contain" style="background:transparent;z-index:9999;positions:absolute;display:none;">
                <div class="focusout-profile-search-loader"></div>
              </div>

            </div>

            <?php echo Form::close(); ?>
          </div>

        </div>

    </div>
    <!-- End Button -->


    @endif

      <!-- Old Hidden Data -->

  </div>


  <?php $bidService = Config::get('bidServices'); ?>
  <select id='bidOptions' class="hide">
    @foreach($bidService[$service] as $key=>$option)
      @if(isset($userBidPrices[$key]) && $userBidPrices[$key]['type']==='bid' || $userBidPrices[$key]['type'] === null)
        <option data-type="bid" data-value="{{$userBidPrices[$key]['price']}}" value="{{$key}}">{{ isset($option['description']) ? $option['description'] : ''}}</option>
      @else
        <option data-type="fixed" data-value="{{$userBidPrices[$key]['price']}}" value="{{$key}}">{{ isset($option['description']) ? $option['description'] : ''}}</option>
      @endif
    @endforeach
  </select>


  <script type="text/javascript">
    var serviceType = '{{$service}}';
    var BASE_PATH = "<?php echo Config::get('otherconstants.BASE_URL'); ?>";
    var service = "<?php echo $service; ?>";
    var identifier = "<?php echo $identifier; ?>";
    var bidInfo = <?php  echo json_encode($bidService); ?>;
    var username = "<?php echo (isset($result['data']['username'])) ? $result['data']['username'] : ''?>";
  </script>
@stop
@section('js_inline')

	<style>
		#bidUpload { width: 100%; margin: 0 0 15px 0; background: url(/assets/images/profile/upload-img.png) center center no-repeat !important;  background-size: 180px 180px !important;  }
		.upload-image { min-height: 190px;  width: 100%; float: left; }
		#theImg { float: left; width: 100%; height: auto !important;}
		.click-pic { cursor: pointer; position: absolute; top: 0px; float: left; height: 100%; width: 100%; margin: 0; opacity: 0; display: block; }
	</style>


@stop

@section('css_include')
  {{asset_stylesheet('plugins/bootstrapValidator/dist/css/bootstrapValidator.min.css')}}
  {{asset_stylesheet('style/video-js.css')}}
  {{asset_stylesheet('style/videojs-sublime-skin.css')}}
@stop

@section('js_include')
  {{asset_javascript('plugins/bower/bootstrapValidator/dist/js/bootstrapValidator.min.js')}}
  {{asset_javascript('plugins/jquery.fileapi.min.js')}}
  {{asset_javascript('app/bidUpload.min.js')}}
  {{asset_javascript('app/register-image-upload.js')}}
  {{asset_javascript('app/createBid.min.js')}}
  {{asset_javascript('video.js')}}

  <script>

    $(document).ready(function () {

      $('#profile').hide().css('opacity', 1).fadeIn();
      //$(".upload-image").click(function(){ $(".click-pic").trigger("click"); });
      

    });

  </script>

@stop