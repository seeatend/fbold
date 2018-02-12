<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]>
<html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>
<html class="no-js ie9" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en" itemscope itemtype="http://schema.org/Product"> <!--<![endif]-->
	<head>
   	<?php 
    	
    		$url = "/";
    		$current_url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
			if(isset($username)) { $current_url .= "/".$username; } else { $current_url .= $_SERVER["REQUEST_URI"]; }  
   	
   	?>
   
    <meta charset="utf-8">
    <title>@yield('pageTitle', 'Your Social Media Task Provider  |  Followback')</title>
    <meta name="robots" content="index, follow"/>
    <meta name="description" content="@if (isset($description)){{ $description }} @else A marketplace to buy or sell social media tasks. @endif"/>
    <meta name="keywords" content="@if (isset($keywords)){{ $keywords }} @endif"/>
    <meta property="og:title" content="@yield('pageTitle', 'Your Social Media Task Provider  |  Followback')" />
    <meta property="og:description" content="@if (isset($description)){{ $description }} @endif"/>
    <meta property="og:image" content="http://www.followback.com/favicon.png">
    <meta property="og:image" content="http://www.followback.com/assets/images/logo.png">
    <meta property="og:image" content="@if (isset($avatar)){{ 'http://www.followback.com'.$avatar }} @else {{ 'http://www.followback.com/assets/images/homepage/homepage.jpg'  }} @endif ">
    <meta property="og:url" content="<?php echo $current_url; ?>"/>
    <meta name="csrf-token" content="<?= csrf_token() ?>">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />
   
    <link rel="shortcut icon" sizes="32x32" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="/favicon.png"/>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/awesome-bootstrap-checkbox.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet" type="text/css">
    <!-- <link type="text/css" rel="stylesheet" href="bootstrap-toggle.min.css,awesome-bootstrap-checkbox.css,app.css" /> -->
     <link rel="canonical" href="<?php echo $current_url; ?>"/>

    @yield('css_include')
    @yield('css_inline')

  </head>

  <body class='home @yield('body_class')'>
    <div class="user-messages">
      @include('layouts.partials.frontend._messages')
    </div>
    @include('partials/new-search-container')
   
	<script>
 			var BASE_PATH = "<?php echo Config::get('otherconstants.BASE_URL'); ?>";
	</script>

	{{-- LOADER --}}
	<div class="home-loader"></div>

	{{-- MASTHEAD --}}
	
	<div id="wrapper" style="overflow: hidden;">
		<div class="intro-image">

			<div class="featured-float" style="padding-bottom: 0px; background: rgba(1,1,1,0.75);  background-position: center;  background-size: cover;">
				<div class="container" id="super_header" style="background: transparent;">
	  				<div class="row" style="padding: 0; margin: 0;">
		 				<div class="col-md-12" style="padding: 0; margin: 0;">
							
		 
							<p class="header-text">
							Get Real People to <br>Promote on Social Media.
							</p>



<div class="clearfix" style="height: 1px;"></div>
	<div id="home-search-container">
								<input id="home-search-input" class="fb-home-search" placeholder="" type="text" />
							</div>
 <span class="homepage-subtext">Promote with the Help of Everyday People, <br>Influencers and Celebrities. </span>

 
 <br><br><br>&nbsp;<br>
							{{--
							<div id="home-search-container">
								<a href="#" class="info"><span class="right">You can search by entering a username, a popular hashtag or the amount of followers.</span><ins class="fa fa-question-circle"></ins></a>
								<input id="home-search-input" class="fb-home-search" placeholder="" type="text" />
							</div>
							--}}
		 				</div>
	  				</div>
				</div>
			</div>
		
		</div>
		<div class="clearfix"></div>

	<div id="tags">
		<div class="row">
			<div class="col-md-12">
				<h2 class="homepage-heading">Find a Popular User to do a <br>Social Media Task!</h2>
		 	</div>
		 	<div class="clearfix" style="height: 10px;"></div>
	  	</div>
		@include('partials._listing-tags')
	</div>
	
	<div id="follower-count">
		<div class="clearfix" style="height: 50px;"></div>
		<h2 class="homepage-heading text-center">Find a User by the Number of Followers.</h2>
	
	{{--	<div class="clearfix" style="height: 5px;"></div>
		<p class="text-center">#FunFact Our Users combined have over a Billion Followers on Social Media.</p>
		--}}
		<div class="clearfix" style="height: 20px;"></div>

		<div class="count-set">
{{--
		  <div class="count-columns">
			  <a href="/followers/1-500" style="background-color: #9a56ff;">
				 <div class="panel panel-default">
					<div class="panel-footer firstbox">
					<img src="/assets/images/icon-followers.png" width="649" height="560" alt="icon-followers" style="opacity: .15; width: 80%; height: auto !important; margin: 0 auto; clear: both; display: block;">
					<span style="display: block; margin: 0 0 10px 0;">1-500</span></div>
				 </div>
			  </a>
			</div>	 	
--}}			
		
		  <div class="count-columns">
			  <a href="/followers/500-1K">
				 <div class="panel panel-default">
					<div class="panel-footer secondbox">
					<img src="/assets/images/icon-followers.png" width="649" height="560" alt="icon-followers" style="opacity: .2; width: 80%; height: auto !important; margin: 0 auto; clear: both; display: block;">
					<span style="display: block; margin: 0 0 10px 0;">500-1K</span></div>
				 </div>
			  </a>
			</div>	 		
		
		  <div class="count-columns">
			  <a href="/followers/1-5K">
				 <div class="panel panel-default">
					<div class="panel-footer thirdbox">
					<img src="/assets/images/icon-followers.png" width="649" height="560" alt="icon-followers" style="opacity: .35; width: 80%; height: auto !important; margin: 0 auto; clear: both; display: block;">
					<span style="display: block; margin: 0 0 10px 0;">1-5K</span></div>
				 </div>
			  </a>
			</div>	
		
		  <div class="count-columns">
			  <a href="/followers/5-10K">
				 <div class="panel panel-default">
					<div class="panel-footer fourthbox">
					<img src="/assets/images/icon-followers.png" width="649" height="560" alt="icon-followers" style="opacity: .4; width: 80%; height: auto !important; margin: 0 auto; clear: both; display: block;">
					<span style="display: block; margin: 0 0 10px 0;">5-10K</span></div>
				 </div>
			  </a>
			</div>	 		
		
		  <div class="count-columns">
			  <a href="/followers/50-100K">
				 <div class="panel panel-default">
					<div class="panel-footer fifthbox">
					<img src="/assets/images/icon-followers.png" width="649" height="560" alt="icon-followers" style="opacity: .55; width: 80%; height: auto !important; margin: 0 auto; clear: both; display: block;">
					<span style="display: block; margin: 0 0 10px 0;">50-100K</span></div>
				 </div>
			  </a>
			</div>	
		
		  <div class="count-columns">
			  <a href="/followers/100-500K">
				 <div class="panel panel-default">
					<div class="panel-footer sixthbox">
					<img src="/assets/images/icon-followers.png" width="649" height="560" alt="icon-followers" style="opacity: .6; width: 80%; height: auto !important; margin: 0 auto; clear: both; display: block;">
					<span style="display: block; margin: 0 0 10px 0;">100-500K</span></div>
				 </div>
			  </a>
			</div>	
		
		  <div class="count-columns">
			  <a href="/followers/500K-1M">
				 <div class="panel panel-default">
					<div class="panel-footer seventhbox">
					<img src="/assets/images/icon-followers.png" width="649" height="560" alt="icon-followers" style="opacity: .75; width: 80%; height: auto !important; margin: 0 auto; clear: both; display: block;">
					<span style="display: block; margin: 0 0 10px 0;">500K-1M</span></div>
				 </div>
			  </a>
			</div>	 		
		
		  <div class="count-columns">
			  <a href="/followers/1-5M">
				 <div class="panel panel-default">
					<div class="panel-footer eighthbox">
					<img src="/assets/images/icon-followers.png" width="649" height="560" alt="icon-followers" style="opacity: .8; width: 80%; height: auto !important; margin: 0 auto; clear: both; display: block;">
					<span style="display: block; margin: 0 0 10px 0;">1-5M</span></div>
				 </div>
			  </a>
			</div>	
		
		  <div class="count-columns">
			 <a href="/followers/5-10M">
				<div class="panel panel-default">
				  <div class="panel-footer ninthbox">
				  <img src="/assets/images/icon-followers.png" width="649" height="560" alt="icon-followers" style="opacity: .9; width: 80%; height: auto !important; margin: 0 auto; clear: both; display: block;">
				  <span style="display: block; margin: 0 0 10px 0;">5-10M</span></div>
				</div>
			 </a>
		  </div>
		 
		  <div class="count-columns">
			  <a href="/followers/10M+">
				 <div class="panel panel-default">
					<div class="panel-footer tenthbox">
					<img src="/assets/images/icon-followers.png" width="649" height="560" alt="icon-followers" style="opacity: 1; width: 80%; height: auto !important; margin: 0 auto; clear: both; display: block;">
					<span style="display: block; margin: 0 0 10px 0;">10M+</span></div>
				 </div>
			  </a>
		  </div>
		</div>
	
		
		<div class="clearfix" style="height: 60px;"></div>
		</div><!-- END: follower-count -->
	
	
	<div id="how_it_works" class="how-bg">
	<div id="how">
	<div class="container">
		<div class="row how-it-works">
	  <div class="col-md-12">
		  <h2 class="homepage-heading text-center">How Followback Works</h2>
		  <div class="clearfix" style="height: 25px;"></div>
		  
		  <div style="width: 100%; max-width: 1200px; margin: 0 auto;">
		  <div class="row">
		  		 <div class="col-sm-4 columns text-center">
		  		 	<img src="/assets/images/icon-magnify.png" width="146" height="146" alt="icon-magnify">
		  		 	<h3>Search for a user</h3>
		  		 	<span>Search for a user you want a social media task down by.</span>
		  		 </div>
		  		 <div class="col-sm-4 columns text-center">
		  		 	<img src="/assets/images/icon-clipboard.png" width="146" height="146" alt="icon-magnify">
		  		 	<h3>Fill out instructions</h3>
		  		 	<span>Fill out the instructions needed in order for the social media task to be done.</span>
		  		 </div>
		  		 <div class="col-sm-4 columns text-center">
		  		 	<img src="/assets/images/icon-dollar.png" width="146" height="146" alt="icon-magnify">
		  		 	<h3>30 day guarantee</h3>
		  		 	<span>If your task is accepted it will remain done for a minimum of 30 days guaranteed.</span>
		  		 </div>		  		 		  
		  </div>
		  </div>
		  <div class="clearfix" style="height: 90px;"></div>
	  </div>
	  <h2 class="homepage-heading text-center">Why Use Followback?</h2>
	  <div class="clearfix" style="height: 50px;"></div>
	  <div id="WhyFollowback" class="container">
	 		<div class="row">
	  			<div class="cols">
	  				<div class="col-content">
	  					<span class="icon why-list" style="background: #00fd40 url(/assets/images/icon-card.png) center center no-repeat;"></span>
	  					<span class="text"><span class="valign">New Revenue Stream</span></span>
	  				</div>
	  			</div>
	  			<div class="cols">
	  				<div class="col-content">
	  					<span class="icon why-list" style="background: #ff3def url(/assets/images/icon-list.png) center center no-repeat;"></span>
	  					<span class="text"><span class="valign">Get a social media task done by a person you want</span></span>
	  				</div>
	  			</div>
	  			<div class="half-separator"></div>
	  			<div class="cols">
	  				<div class="col-content">
	  					<span class="icon why-calendar" style="background: #11e7f6 url(/assets/images/icon-calendar.png) center center no-repeat;"></span>
	  					<span class="text"><span class="valign">30 day buyer/seller protection</span></span>
	  				</div>
	  			</div>
	  			<div class="third-separator"></div>
	  			<div class="cols">
	  				<div class="col-content">
	  					<span class="icon why-users" style="background: #9a56ff url(/assets/images/icon-users.png) center center no-repeat;"  ></span>
	  					<span class="text"><span class="valign">Direct access - No middleman</span></span>
	  				</div>
	  			</div>
	  			<div class="half-separator"></div>
	  			<div class="cols">
	  				<div class="col-content">
	  					<span class="icon why-briefcase" style="background: #00b1ff url(/assets/images/icon-briefcase.png) center center no-repeat;"  ></span>
	  					<span class="text"><span class="valign">Use Followback for personal or business use</span></span>
	  				</div>
	  			</div>
	  			<div class="cols">
	  				<div class="col-content">
	  					<span class="icon why-fire" style="background: #ff2500 url(/assets/images/icon-fire.png) center center no-repeat;" ></span>
	  					<span class="text"><span class="valign">Our users have over 900 million followers on social media</span></span>
	  				</div>
	  			</div>	
	  		</div>	  		
	  		
	  </div>
	   <div class="clearfix" style="height: 70px;"></div>
	  
	</div>
	</div>
	<div class="clearfix" style="height: 10px;"></div>
	</div>
	</div>
	 @include('layouts.partials.homepage._footer')
 </div>
 
   @include('layouts.partials.homepage._header._nav')
 <script
  src="http://code.jquery.com/jquery-1.11.0.min.js"
  integrity="sha256-spTpc4lvj4dOkKjrGokIrHkJgNA0xMS98Pw9N7ir9oI="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="{{asset('assets/js/site.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/main.js')}}"></script>

   @yield('js_include')
   @yield('js_inline')

   <script type="text/javascript">
		var BASE_PATH = "<?php echo Config::get('otherconstants.BASE_URL'); ?>";

      $(function () {
        $.ajaxSetup({
          headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
          }
        });
      });
   </script>
	<script type="text/javascript">
		 var MTUserId='2583f09c-7450-45ea-bd8b-ded4a8e1233f';
		 var MTFontIds = new Array();

		 MTFontIds.push("1459684"); // Neue Helvetica® W04 35 Thin 
		 MTFontIds.push("1459692"); // Neue Helvetica® W04 55 Roman 
		 (function() {
			var mtTracking = document.createElement('script');
			mtTracking.type='text/javascript';
			mtTracking.async='true';
			mtTracking.src='/assets/mtiFontTrackingCode.js';

			(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(mtTracking);
		 })();
	</script>
   <script>
      (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
          }, i[r].l = 1 * new Date();
        a = s.createElement(o),
          m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
      })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

      ga('create', 'UA-61954822-1', 'auto');
      ga('send', 'pageview');

   </script>
<script type='text/javascript'>


$(document).ready(function(){

var top = 0;

if($(window).width() <= 767){

	top = 120;

}


if($(window).height() > 480){
	$(".intro-image,.featured-float").css("height",$(window).height()-top);
} else {
	$(".intro-image,.featured-float").css("height",480);
}
$(window).resize(function(){
	
	if($(window).width() <= 767){

	top = 120;

	}
	
	if($(window).height() > 480){
		$(".intro-image,.featured-float").css("height",$(window).height()-top);
	} else {
		$(".intro-image,.featured-float").css("height",480);
	}


});
$(".submenu").click(function(){

	if($(this).hasClass("on")){
		$(this).removeClass("on");
		$(".submenu-item").removeClass("on");
		
		
	} else {
	
		$(this).addClass("on");
		$(".submenu-item").addClass("on");
		
	
	}
	return false;

});

});
if (('localStorage' in window) && window.localStorage !== null) {

	if(localStorage.loader){
	
		
		 	$(".home-loader").fadeOut("fast");

	
		
	} else {
	
	
			var checker = "";
			var number = 0;
 			if($(".home-loader:visible").length){
 	   		checker = setInterval(function(){ 
					number++; 
					if($(".home-loader:visible").length && number <= 100){
						$(".home-loader").html(" &nbsp; "+number+"% ");
						$(".home-loader").fadeOut("fast").html(" &nbsp; ");
			
					} else if(number >= 100){
						$(".home-loader").html(" &nbsp; ");
						$(".home-loader").fadeOut("fast");
						clearInterval(checker);
						localStorage.loader = number;
					} else {	
					$(".home-loader").fadeOut("fast");
						$(".home-loader").html(" &nbsp; ");
						clearInterval(checker);
						localStorage.loader = number;
					}
 	    		}, 100);
 			} else {
 				clearInterval(checker);
				$(".home-loader").fadeOut("fast");

 			}

	
	}
  
  
} else {

 $(".home-loader").fadeOut("fast");


 
}

$('.internal').on('click',function (e) {

	    e.preventDefault();
	    var target = this.hash;
	    var $target = $(target);
	
      
	    if($target.length){ 
	    	 var $loc = -100+$target.offset().top;
			  $('html, body').animate({
					scrollTop: $loc
			  }, 1000);	
	    
	    } else {
	    	
	    	 window.location = "/"+target;
	    
	    }
	});

if(window.location.hash.length > 1) 
	{
		window.scrollTo(0, 0); 
		$(".home-loader").hide();
		var target = window.location.hash;
		var $target = $(target);
		var $loc = -100+$target.offset().top;
		$target.css("opacity",0);
		setTimeout(function(){
			$target.css("opacity",.2);
			  $('html, body').animate({
						scrollTop: $loc
				  }, 1000,function(){ $(target).animate({"opacity":1},200);  });
				  return false;
	  },1000);
	} else {}	

$(".submenu").click(function(){

	if($(this).hasClass("on")){
		$(this).removeClass("on");
		$(".submenu-item").removeClass("on");
		
		
	} else {
	
		$(this).addClass("on");
		$(".submenu-item").addClass("on");
		
	
	}
	return false;

});

</script> 
	</body>
</html>
