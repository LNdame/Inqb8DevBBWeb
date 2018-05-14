<!-- Left side column. contains the logo and sidebar -->
<?php
$establishment = \App\Establishment::where('id', Auth::user()->establishment_id)->first();?>
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel" style="height: 8em;">
                <div class="pull-left image">
                    <a href="{{ url('/update_user_profile/'.\Illuminate\Support\Facades\Auth::user()->id) }}"> <img
                                src="{{isset($user->picture_url)? $user->picture_url:Gravatar::get($user->email) }}"
                                class="img-circle" alt="User Image"/></a>
                </div>
                <div style="margin-left:2em;margin-top:2em;">
                    <a href="#" style="padding:1em;"><i class="fa fa-circle text-success"
                                                        s></i> {{ trans('adminlte_lang::message.online') }}
                    </a>
                </div>
            </div>
            <div class="info" style="margin-left: 1em;">
                <p style="color:white;">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name}}</p>
                <p style="color:white;">{{$establishment->name}}</p>
                <!-- Status -->
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
            <li class="header">Navigation</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="#"><a href="{{url('/home')}}"><i class='fa fa-home'></i> <span
                            style="cursor:pointer;">Dashboard</span></a></li>
            <li class="#"><a href="{{url('/get_promotions')}}"><i class='fa fa-hourglass-start'></i> <span
                            style="cursor:pointer;">Promotions</span></a></li>
            <li class="#"><a href="{{url('/get_establishments')}}"><i class='fa fa-building'></i> <span
                            style="cursor:pointer;">Establishments</span></a></li>
            {{--<li class="#"><a href="{{url('get_menus')}}"><i class='fa fa-users'></i> <span--}}
            {{--style="cursor:pointer;">Menus</span></a></li>--}}
            <li class="#"><a href="#"><i class='fa fa-hourglass-start'></i> <span
                            style="cursor:pointer;">Events</span></a></li>
            <hr/>
            <li class="treeview">
                <a><i class='fa fa-users'></i> <span style="cursor:pointer;">User Management</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="#"><a href="{{ url('/list_users') }}"><i class='fa fa-address-card'></i>
                            <span>Users</span></a></li>
                </ul>
            </li>


        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

