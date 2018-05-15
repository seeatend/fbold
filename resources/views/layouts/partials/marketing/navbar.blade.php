<header class="main-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <nav class="navbar navbar-default">
                    <div class="">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" id="nav-hamburger" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="19" viewBox="0 0 23 19"><g fill="none"><g fill="#555"><rect y="16" width="23" height="3" rx="1.5"></rect><rect width="23" height="3" rx="1.5"></rect><rect y="8" width="23" height="3" rx="1.5"></rect></g></g></svg>
                            </button>
                            <a class="navbar-brand" href="/"><img src="/marketing/images/logo.png" alt=""></a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right" style="width: auto !important;">
                                <li><a href="/#cat">Categories </a></li>
                                <li><a href="#" id="home-search-input" class="home-search-input RunSearch">Search</a></li>
                                @if (!\Sentry::check())
                                    <li><a href="/become-seller">Become a Monetizer </a></li>
                                    <li><a href="/#" data-toggle="modal" data-backdrop="true" data-target="#SignUpModal">Sign Up</a></li>
                                    <li><a href="/#" data-toggle="modal" data-backdrop="true" data-target="#LoginModal">Log In</a></li>
                                @else
                                    <li>
                                        <a href="/socialtasks" title="requests">Requests</a>
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