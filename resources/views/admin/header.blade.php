<?php
$notifications = auth()->user()->notifications()->where('read_at', null)->get();
?>
<header class="header twitter-bg">
    <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i
                class="icon_menu"></i></div>
    </div>

    <!--logo start-->
    <a href="{{route('dashboard.home')}}" class="logo" style="color:  #fff;">SDLF</a>
    <!--logo end-->

    <div class="nav search-row" id="top_menu">
        <!--  search form start -->
        <ul class="nav top-menu">
            <li>
                <form class="navbar-form">
                    <input class="form-control" placeholder="Search" type="text">
                </form>
            </li>
        </ul>
        <!--  search form end -->
    </div>
    <div class="top-nav notification-row">
        {{--    home page--}}
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">
            <!-- alert notification start-->
            <li id="alert_notificatoin_bar" class="dropdown">
                <a href="{{route('notifications')}}">

                    <i class="icon-bell-l"></i>
                    <span class="badge bg-important">{{$notifications->count()}}</span>
                </a>
            </li>
            <!-- alert notification end-->
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                          <span class="profile-ava">
                              <img alt="" width="30" height="30" src="{{asset('images/profile-picture.png')}}">
                          </span>
                    @if (auth()->user())
                        <span class="username">{{auth()->user()->name}}</span>
                    @endif
                    {{--                    <b class="caret"></b>--}}
                </a>
                <ul class="dropdown-menu extended logout">
                    <div class="log-arrow-up"></div>
                    <li class="eborder-top">
                        <a href="/"><i class="fa fa-home"></i> Home page</a>
                    </li>

                    <li class="eborder-top">
                        <a href="{{ route('admin.profile') }}">
                            <i class="icon_profile"></i> My Profile
                        </a>
                    </li>

                    <li class="eborder-top">
                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <button type="submit" class="btn dropdown-item p-2 m-2" style="text-align: left; width: 100%;">
                                <i class="fa fa-sign-out text-danger"></i>
                                <span class="text-danger"> Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
            <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
    </div>
</header>
