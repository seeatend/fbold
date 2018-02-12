<div class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="{{URL::route('admin_dashboard')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{route('admin_users_index')}}">Users</a>
                </li>
                <li>
                    <a href="{{route('admin_bids_index')}}">Bids</a>
                </li>
                <li>
                    <a href="{{route('admin_most_search_user_settings_index')}}">Most Search User Settings </a>
                </li>
                <li>
                    <a href="{{route('admin_verified_users_index')}}">Verified Users </a>
                </li>
                <li>
                    <a href="{{route('admin_settings_index')}}">Settings</a>
                </li>


                {{--<li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="flot.html">Flot Charts</a>
                        </li>
                        <li>
                            <a href="morris.html">Morris.js Charts</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level
                </li> -->--}}
            </ul>
            <!-- /#side-menu -->
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->