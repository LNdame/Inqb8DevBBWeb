<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel" style="height: 8em;">
                <div class="pull-left image">
                    <a href="{{ url('/update_user_profile/'.\Illuminate\Support\Facades\Auth::user()->id) }}"> <img
                                src="{{isset($user->picture_url)? "/".$user->picture_url:Gravatar::get($user->email) }}"
                                class="img-circle" alt="User Image"/></a>
                </div>
                {{--<div class="pull-left info">--}}
                    {{--<p>{{ Auth::user()->name }}</p>--}}
                    {{--<!-- Status -->--}}
                    {{--<a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>--}}
                {{--</div>--}}
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
            <li class="header">Admin Settings</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview" >
                <a ><i class='fa fa-building'></i> <span style="cursor:pointer;">Establishments</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('get_establishments')}}">Establishments List</a></li>
                    <li><i class="fa fa-cubes"></i> <a href="get_establishments_types">Establishment Types</a></li>
                    <li><i class='fa-money'></i><a href="get_establishments_accounts">Establishment Accounts</a></li>
                </ul>
            </li>
            <li class="#"><a href="{{url('get_beers')}}"><i class='fa fa-users'></i> <span
                            style="cursor:pointer;">Beers</span></a>
            </li>
            <li class="#"><a href="{{url('get_establishment_events')}}"><i class='fa fa-users'></i> <span
                            style="cursor:pointer;">Events</span></a></li>
            <li class="#"><a href="{{url('get_menus')}}"><i class='fa fa-users'></i> <span
                            style="cursor:pointer;">Menus</span></a></li>
            <li class="#"><a href="{{url('get_promotions')}}"><i class='fa fa-hourglass-start'></i> <span
                            style="cursor:pointer;">Promotions</span></a></li>
            <hr/>
            <li class="treeview">
                <a ><i class='fa fa-users'></i> <span style="cursor:pointer;">User Management</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="#"><a href="{{ url('/list_users') }}"><i class='fa fa-address-card'></i> <span>Users</span></a></li>
                    <li class="#"><a href="{{ url('get_beer_lovers') }}"><i class='fa fa-users'></i> <span>Beer Lovers</span></a></li>
                    <li class="#"><a href="#"><i class='fa fa-reorder'></i> <span style="cursor:pointer;">Preferences</span></a></li>
                    <li><a href="{{url('roles')}}"><i class='fa fa-cog'></i> <span>Roles</span></a></li>
                    <li><a href="{{url('permissions')}}"><i class='fa fa-cog'></i> <span>Permissions</span></a></li>
                </ul>
            </li>



        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

