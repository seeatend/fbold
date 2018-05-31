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
<?php
	$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  	$current_url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
	if(isset($username)) { $current_url .= "/".$username; } else { $current_url .= $_SERVER["REQUEST_URI"]; }
?>

  <head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
	  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />
	  {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> --}}
	  <meta charset="utf-8">
	  <meta name="description" content="@if (isset($description)){{ $description }} @endif"/>
	  <meta name="keywords" content="@if (isset($keywords)){{ $keywords }} @endif"/>
	  <meta property="og:url" content="<?php echo $current_url; ?>"/>
	  <meta property="og:description" content="@if (isset($description)){{ $description }} @endif"/>

	  <title>
		  @if (isset($title)){{ $title }}   |
		  @elseif (isset($username))
			  {{ $username }}   |
		  @endif
		  @yield('pageTitle', 'Followback')</title>
	  <meta property="og:title" content=" @if (isset($title)){{ $title }}   | @elseif (isset($username)) {{ $username }}   | @endif @yield('pageTitle', 'Followback')"/>
	  <meta property="og:title" content="@yield('pageTitle', 'Your Social Media Task Provider  |  Followback')"/>
	  <meta property="og:image" content="http://www.followback.com/assets/images/favicon.png">
	  <meta property="og:image" content="@if (isset($avatar)){{ 'http://www.followback.com'.$avatar }} @else {{ 'http://www.followback.com/assets/images/homepage/homepage.jpg'  }} @endif ">
	  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />
	  <meta name="robots" content="index, follow"/>
	  <!-- Bootstrap -->
	  <link href="/marketing/css/bootstrap.min.css" rel="stylesheet">
	  <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">
	  <link href="/marketing/fonts/stylesheet.css" rel="stylesheet">
	  <link href="/marketing/css/style.css?v=1.3" rel="stylesheet">
	  <link href="/marketing/css/responsive.css?v=1.2" rel="stylesheet">
	  <link href="/marketing/css/auth-modal-hacks.css" rel="stylesheet">

	  <link href="/marketing/css/jquery.mb.vimeo_player.min.css" rel="stylesheet">
	  <link href="/marketing/css/owl.carousel.min.css" rel="stylesheet">
	  <!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	  <![endif]-->
	  <link href="{{asset('assets/css/app.css')}}" rel="stylesheet" type="text/css">
	  <style>
		  body{
			  font-family: "CircularStd" !important;
			  letter-spacing: 0em !important;
		  }
		  .main-header .navbar-default .navbar-nav>li>div {
			  color: #6b6b6b;
			  font-size: 14px;
			  letter-spacing: .01em;
			  padding: 22.5px 0px;
			  border-bottom: 2px solid transparent;
		  }
		  .dropdown-menu{
			  position:fixed;
			  top:77px;
		  }
		  #navbar, .navbar-nav {
			  width: auto !important;
		  }
		  .sticky {
			  position: fixed;
			  top: 0;
			  width: 100%;
			  z-index: 100;
			  border: 1px solid lightgray;
		  }
		  .widget h3{
			  font-family: "CircularStd" !important;

			  font-weight: 500 !important;
		  }


	  </style>
  </head>

  <body style="padding: 0 !important;">
  @include('partials/new-search-container')
  @if(!\Sentry::check())
	  @include('layouts.partials.modals.login')
	  @include('layouts.partials.modals.signup')
  @endif
  <!--   /*====================== Header =============================*/-->
  @include('layouts.nav2')

  <div class="user-messages">
	  @include('layouts.partials.frontend._messages')
  </div>

    <div class="home-loader"></div>

    <div id="preloader5" style="display:none;"></div>
    <div id="wrapper">
    <div class="sticky-clearfix"></div>

      @yield('content')
    </div>
    {{--@include('layouts.partials.homepage._header._nav')--}}
      <!-- Twitter -->
    <a href="https://twitter.com/followback" title="Followback Twitter"></a>

	<div class="popup-overlay">
		<div class="box">
			<a href="#" class="popup-close">&times;</a>
			<h3 style="margin: 0 0 18px 0; color: #0068E1;">Verify Your Account</h3><p>Followback verifies accounts on an ongoing basis to make it easier for users to find who they are looking for. Verification is used to establish authenticity of key individuals and brands. We concentrate on highly sought users in music, acting, fashion, politics, religion, journalism, media, sports, business and other key interest areas. </p>
			<p>Please note that verification does not factor in the amount of followers you have on social media. Any account with a blue verified badge on their Followback page is a verified account. To get verified you must provide us with one of the following:</p>
			<ol>
				<li>Link your Followback page to your official web page</li>
				<li>Contact us via your personal website email address at <a style="color: #0068E1;" href="mailto:Verify@Followback.com?subject=Verify%20Followback%20Account" target="_blank">Verify@Followback.com</a></li>
				<li>Post your Followback.com link  (i.e. Followback.com/username) on any of your public social media accounts.</li>
			</ol>
		</div>
	</div><!-- END: popup-overlay -->

  

    {{asset_javascript('site.js')}}
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>
    {{asset_javascript('plugins.js')}}
    {{asset_javascript('jquery.maskedinput.min.js')}}
    {{asset_javascript('main.js')}}

    @yield('js_include')
    @yield('js_inline')
    
	 <script type="text/javascript">
		 var MTUserId='2583f09c-7450-45ea-bd8b-ded4a8e1233f';
		 var MTFontIds = new Array();

		 MTFontIds.push("1459684"); // Neue Helvetica® W04 35 Thin 
		 MTFontIds.push("1459692"); // Neue Helvetica® W04 55 Roman 
		 (function() {
			var mtTracking = document.createElement('script');
			mtTracking.type='text/javascript';
			mtTracking.async='true';
			mtTracking.src='/assets/js/mtiFontTrackingCode.js';

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
		window.onload=function(){
			var checker = "";
			var number = 0;
			if($(".home-loader:visible").length){
				checker = setInterval(function(){ 
					number++; 
					if($(".home-loader:visible").length && number <= 100){
						$(".home-loader").html(" &nbsp; "+number+"% ");
						$(".home-loader").fadeOut("fast");
					} else if(number >= 100){
						$(".home-loader").html(" &nbsp; 100% ");
						clearInterval(checker);
						$(".home-loader").fadeOut("fast");
					} else {
						number = 100;
						clearInterval(checker);
					}
			 }, 100);
		} else {
			clearInterval(checker);
		}
	}

	function showMenu(){
		    $('#bs-example-navbar-collapse-1').toggle('slow');
	}
        function show_menu(){
            $('.menudown').toggle();
        }


	</script> 
    <!-- begin olark code -->
    <script type="text/javascript" async> ;(function(o,l,a,r,k,y){if(o.olark)return; r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0]; y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r); y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)}; y.extend=function(i,j){y("extend",i,j)}; y.identify=function(i){y("identify",k.i=i)}; y.configure=function(i,j){y("configure",i,j);k.c[i]=j}; k=y._={s:[],t:[+new Date],c:{},l:a}; })(window,document,"static.olark.com/jsclient/loader.js");
    /* custom configuration goes here (www.olark.com/documentation) */
    olark.identify('9892-959-10-1592');</script>
<!-- end olark code -->
	</body>
</html>