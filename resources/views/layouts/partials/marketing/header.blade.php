<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    {{-- <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" /> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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

</head>

<body style="padding: 0 !important;">
    @if(!\Sentry::check())
        @include('layouts.partials.modals.login')
        @include('layouts.partials.modals.signup')
    @endif
    <!--   /*====================== Header =============================*/-->
    @include('layouts.partials.marketing.navbar')
    <div class="user-messages">
        @include('layouts.partials.frontend._messages')
    </div>
    @include('partials/new-search-container')