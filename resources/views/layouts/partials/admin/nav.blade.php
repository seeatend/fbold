<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin v2.0</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        
                        <i class="fa fa-user fa-fw"></i> {{ Config::get('otherconstants.ADMIN_DEFAULT_IMAGE') }} <i class="fa fa-caret-down"></i>

                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{URL::route('profile_connect')}}">Back to Dashboard</a></li>
                        <li class="divider"></li>
                        <li><a href="{{URL::route('admin_change_password')}}"><i class="fa fa-sign-out fa-fw"></i> Change Password</a>
                        <li class="divider"></li>
                        <li><a href="{{URL::route('auth_logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            @include('layouts.partials.admin.sidebar')
        </nav>