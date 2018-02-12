<?php

// if(isset($_COOKIE["TestCookie"])) {

?>

<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>@yield('title', 'FollowBack - Admin')</title>
        <!-- Core CSS - Include with every page -->
        

        
		<!--  
			{{asset_stylesheet('plugins/font-awesome/css/font-awesome.min.css')}} -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        {{asset_stylesheet('plugins/colorbox/colorbox.css')}}
        {{asset_stylesheet('admin/admin.min.css')}}
        {{asset_stylesheet('style/bootstrap.css')}}
        {{asset_stylesheet('style/confirm-dialog.css')}}
        {{asset_stylesheet('style/loginsignup.css')}}
     <!--   {{asset_stylesheet('style/video-js.css')}}
        {{asset_stylesheet('style/videojs-sublime-skin.css')}}
        -->
        <link rel="apple-touch-icon" href="/favicon.png"/>
        <script type="text/javascript" async src="//platform.twitter.com/widgets.js"></script>  
    </head>
<body>
    <div id="wrapper">
        @include('layouts.partials.admin.nav')
        <div id="page-wrapper">
        @include('layouts.partials.admin.messages')
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('main_header', 'Header')</h1>
                    @yield('content')
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    {{asset_javascript('application.min.js')}}
    {{asset_javascript('jquery-ui.js')}}
    {{asset_javascript('plugins/colorbox/jquery.colorbox.js')}}
    {{asset_javascript('handlecolorbox.js')}}
    {{asset_javascript('jquery.media.js')}}
    {{asset_javascript('admin/jquery.stickytableheaders.min.js')}}
    {{asset_javascript('admin/admin.js')}}
    
    @yield('js_include')
    @yield('js_inline')
    
</body>

</html>
 
<?php

// } else {


// header("Location: http://www.followback.com");
// die();


// } 
?>
