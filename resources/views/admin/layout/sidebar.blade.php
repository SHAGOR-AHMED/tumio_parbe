<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
            <div class="pull-left">
                <img src="{{ asset('admin/images/icon.png') }}" alt="logo" class="thumb-md img-circle">
            </div>
            <div class="user-info">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false">{{ logged_in_name() }}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('user.edit', ['user_id' => logged_in_user_id()]) }}"><i class="md md-settings"></i>Reset Profile</a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="md md-administrators-power"></i> Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>

                <p class="text-muted m-0">{{ logged_in_role_name() }}</p>
            </div>
        </div>
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect {{ set_Topmenu('dashboard') }}">
                        <i class="fa fa-home"></i><span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('course.add') }}" class="waves-effect {{ set_Topmenu('course') }}">
                        <i class="fa fa-home"></i><span> Manage Course </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('batch.add') }}" class="waves-effect {{ set_Topmenu('batch') }}">
                        <i class="fa fa-home"></i><span> Manage Batch </span>
                    </a>
                </li>
            
                <li class="has_sub">
                    <a href="#" class="waves-effect {{ set_Topmenu('administrator') }}">
                        <i class="fa fa-dashboard"></i><span>Administrator </span>
                        <span class="pull-right"><i class="fa fa-plus"></i></span>
                    </a>
                    <ul class="list-unstyled">
                        <li class="{{ set_Submenu('administrator') }}"><a href="{{ route('admin.user') }}">Manage User</a></li>
                    </ul>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->
