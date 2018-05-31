<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> --}}
    <meta name="author" content="">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">
    <link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon">
    <title>Followback</title>
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
        z-index: 1;
        border: 1px solid lightgray;
    }
    .widget h3{
        font-family: "CircularStd" !important;

        font-weight: 500 !important;
    }

    .buyer-faq-banner, #wrapper{
     margin-top: 67px;
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
    @include('layouts.partials.marketing.navbar')

    <div class="user-messages">
        @include('layouts.partials.frontend._messages')
    </div>
