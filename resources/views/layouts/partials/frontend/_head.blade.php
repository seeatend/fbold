<head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type"> 
    <title>@yield('pageTitle', 'FollowBack')</title>
    <meta name="viewport" content="width=device-width, initial-scale=.5, maximum-scale=.5" />
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> --}}
    {{asset_stylesheet('bootstrap/bootstrap.min.css')}}
    {{asset_stylesheet('application.min.css')}}
    {{asset_stylesheet('plugins/toastr/toastr.min.css')}}
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
    <link href="/bootstrap/img/favicon.ico" rel="shortcut icon">
    <link href="/bootstrap/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="/bootstrap/img/apple-touch-icon-72x72.png" sizes="72x72" rel="apple-touch-icon">
    <link href="/bootstrap/img/apple-touch-icon-114x114.png" sizes="114x114" rel="apple-touch-icon">
          <!-- CSS code from Bootply.com editor -->
    @yield('css_include')
    @yield('css_inline')
</head>