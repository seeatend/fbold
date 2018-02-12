<!DOCTYPE html>
<html lang="eng">
<head>
  <meta name="google-translate-customization" content="52a88478e6367bf-6b32cb323631a97c-gf3c047d40534bb06-15"></meta>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>@yield('pageTitle', 'FollowBack')</title>

  {{asset_stylesheet('plugins/colorbox/colorbox.css')}}
  {{asset_stylesheet('application.min.css')}}
  {{asset_stylesheet('plugins/toastr/toastr.min.css')}}
  {{asset_stylesheet('style/bootstrap.css')}}
  
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  
  <!-- My Changes -->
    <link rel="stylesheet" href="/resources/demos/style.css">
  <!-- My Changes -->
  {{asset_stylesheet('style/select2.css')}}
  {{asset_stylesheet('style/custom.css')}}
  {{asset_stylesheet('style/everslider.css')}}
  {{asset_stylesheet('style/jquery.switchButton.css')}}
  {{asset_stylesheet('style/jquery.jscrollpane.css')}}
  {{asset_stylesheet('style/jquery.jscrollpane.lozenge.css')}}
  {{asset_stylesheet('style/style.css')}}
  {{asset_stylesheet('style/button.css')}}
  {{asset_stylesheet('style/loginsignup.css')}}
  
  @yield('css_include')
  @yield('css_inline')
</head>
<body class='@yield('body_class')'>
    
    
    @include('layouts.partials.frontend._messages')
    @yield('content')

    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    {{asset_javascript('jquery-ui.js')}}
    {{asset_javascript('jquery.expander.js')}}
    {{asset_javascript('plugins/colorbox/jquery.colorbox.js')}} 
    {{asset_javascript('handlecolorbox.js')}}   
    {{asset_javascript('bootstrap.js')}}
    {{asset_javascript('select2.min.js')}}
    {{asset_javascript('jquery.ddslick.min.js')}}
    {{asset_javascript('jquery.switchButton.js')}}
    {{asset_javascript('jquery.everslider.min.js')}}
    {{asset_javascript('jquery.slimscroll.min.js')}}
    {{asset_javascript('input.js')}}
    {{asset_javascript('custom.js')}}

    

    @yield('js_include')
    @yield('js_inline')    
</body>
</html>