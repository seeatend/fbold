<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">
    <link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon">
    <title>FollowBook | Trust</title>
    <!-- Bootstrap -->
    <link href="/marketing/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">
    <link href="/marketing/fonts/stylesheet.css" rel="stylesheet">
    <link href="/marketing/css/style.css" rel="stylesheet">
    <link href="/marketing/css/responsive.css" rel="stylesheet">
    <link href="/marketing/css/auth-modal-hacks.css" rel="stylesheet">

    <link href="/marketing/css/jquery.mb.vimeo_player.min.css" rel="stylesheet">
    <link href="/marketing/css/owl.carousel.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    @if(!\Sentry::check())
        @include('layouts.partials.modals.login')
        @include('layouts.partials.modals.signup')
    @endif
    <!--   /*====================== Header =============================*/-->
    <header class="main-header navbar-static-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <nav class="navbar navbar-default">
                        <div class="">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="19" viewBox="0 0 23 19"><g fill="none"><g fill="#555"><rect y="16" width="23" height="3" rx="1.5"></rect><rect width="23" height="3" rx="1.5"></rect><rect y="8" width="23" height="3" rx="1.5"></rect></g></g></svg>
                                </button>
                                <a class="navbar-brand" href="/"><img src="images/logo.png" alt=""></a>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="/sort">Categories </a></li>
                                    <li><a href="/search">Search</a></li>
                                    <li><a href="/become-seller">Become a Monetizer </a></li>
                                    @if (!\Sentry::check())
                                        <li><a href="/#" data-toggle="modal" data-backdrop="true" data-target="#SignUpModal">Sign Up</a></li>
                                        <li><a href="/#" data-toggle="modal" data-backdrop="true" data-target="#LoginModal">Log In</a></li>
                                    @else
                                        <li>
                                            <a href="{{ route('profile_followback_profile') }}" title="Settings">Settings</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('auth_logout') }}" title="Log out">Log out</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <!-- /.navbar-collapse -->
                        </div>
                        <!-- /.container-fluid -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <div class="user-messages">
        @include('layouts.partials.frontend._messages')
    </div>