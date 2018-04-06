<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}
                    </a>
                </div>
            </div>
    @endif

    <!-- search form (Optional) -->
    {{--<form action="#" method="get" class="sidebar-form">--}}
    {{--<div class="input-group">--}}
    {{--<input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>--}}
    {{--<span class="input-group-btn">--}}
    {{--<button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>--}}
    {{--</span>--}}
    {{--</div>--}}
    {{--</form>--}}
    <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Account Settings</li>
            <li class="#"><a href="{{url('/home')}}"><i class='fa fa-home'></i> <span
                            style="cursor:pointer;">Dashboard</span></a></li>
            <li class="#"><a href="#"><i class='fa fa-hourglass-start'></i> <span
                            style="cursor:pointer;">Promotions</span></a></li>
            <li class="#"><a href="#"><i class='fa fa-building'></i> <span
                            style="cursor:pointer;">Establishment Details</span></a></li>
            {{--<li class="#"><a href="{{url('get_establishment_events')}}"><i class='fa fa-users'></i> <span--}}
            {{--style="cursor:pointer;">Events</span></a></li>--}}
            <hr/>
            <li class="treeview">
                <a><i class='fa fa-users'></i> <span style="cursor:pointer;">Account Management</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Edit Profile</a></li>

                </ul>
            </li>


        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

