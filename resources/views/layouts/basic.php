<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type"> 
    <meta charset="utf-8">
    <title>@yield('pageTitle', 'FollowBack')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Allan' rel='stylesheet' type='text/css'>
    {{asset_stylesheet('bootstrap/bootstrap.min.css')}}
    {{asset_stylesheet('application.min.css')}}
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
  <body class='@yield('body_class')'>

   @yield('content')

   {{asset_javascript('application.min.js')}}
   @yield('js_include')
   @yield('js_inline')
   <script>
    $(window).load(function () {
        var height = $('html,body').height() > $(window).height() ? ($('html,body').height()) : $(window).height();
        $("#imgBg").css("height", height);
    });
</script>

<script>
 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
     (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
     m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
 })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
 ga('create', null, null);
 ga('send', 'pageview');
</script>
<!-- begin olark code -->
<script type=“text/javascript” async> ;(function(o,l,a,r,k,y){if(o.olark)return; r=“script”;y=l.createElement(r);r=l.getElementsByTagName(r)[0]; y.async=1;y.src=“//“+a;r.parentNode.insertBefore(y,r); y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)}; y.extend=function(i,j){y(“extend”,i,j)}; y.identify=function(i){y(“identify”,k.i=i)}; y.configure=function(i,j){y(“configure”,i,j);k.c[i]=j}; k=y._={s:[],t:[+new Date],c:{},l:a}; })(window,document,“static.olark.com/jsclient/loader.js”);
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify(‘9892-959-10-1592’);</script>
<!-- end olark code -->
</body>
</html>



