<header class="main-header sticky" style="background: #fff">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <nav class="navbar navbar-default nav_bar" style="overflow: hidden;">
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
                            <ul class="nav navbar-nav navbar-right" style="margin-right: -30px;">


                                @if (!\Sentry::check())

                                    <li class="hidden-sm"><a href="/#cat"  class="internal "><span class="vcenter"><span class="valign" style="line-height: 65px; font-family: Arial; font-weight: 900; font-size: 21px;">Categories</span></span></a></li>
                                    <li class="right hidden-sm"><a href="#" class="RunSearch"><span class="vcenter"><span class="valign">Search</span></span></a></li>
                                    <li class="hidden-sm"><a href="/#how_it_works"  class="internal"><span class="vcenter"><span class="valign">Help</span></span></a></li>
                                    <li class="right hidden-sm"><a href="/#" data-toggle="modal" data-backdrop="true" data-target="#SignUpModal"><span class="vcenter"><span class="valign">Sign&nbsp;up</span></span></a></li>
                                    <li class="right hidden-sm"><a href="/#" data-toggle="modal" data-backdrop="true" data-target="#LoginModal"><span class="vcenter"><span class="valign">Log&nbsp;in</span></span></a></li>

                                @else
                                    <li><a href="/#cat"  class="marketing-nav-item internal"><span class="vcenter"><span class="valign" style="">Categories</span></span></a></li>
                                    <li class="right"><a href="#" class="marketing-nav-item RunSearch"><span class="vcenter"><span class="valign">Search</span></span></a></li>
                                    <li><a class="marketing-nav-item" href="/socialtasks"><span class="vcenter"><span class="valign">Requests</span></span></a></li>

                                    <li class="right marketing-nav-item"><a href="{{ route('profile_followback_profile') }}"><span class="vcenter"><span class="valign">Settings</span></span></a></li>
                                    <li class="right marketing-nav-item" style="height: auto;">
                                        <a href="#" class="submenu" onclick="show_menu();"><span class="vcenter"><span class="valign">{{Sentry::getUser()->username}} <i class="fa fa-angle-down"></i></span></span></a>

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
<span class="submenu-item menudown hidden-xs" style="width: 100px;
    height: 50px;
    position: absolute;
    float: right;
    z-index: 10;
    left: 91%;
    background: #fff;
    text-align: center;
    display:none;
}">
<a style="margin-top: 10px;" class="marketing-nav-item" href="{{ route('auth_logout') }}" title="Log out"><span class="vcenter" style="    top: 11px;
    position: relative;"><span class="valign">Log out</span></span></a>
</span>