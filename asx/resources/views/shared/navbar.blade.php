<!-- NAV BAR - Generic sticky navbar, improvements will be made later -->
<div class="sidebarNav">
    <!-- Sidebar -->
    <div class="sidebarNav">

        <div class="row-fluid">
            <div class="row-fluid playerContainer">
                <div class="col-lg-8 col-md-8 col-lg-offset-1 col-md-offset-1 playerTile"><h3><span class="glyphicon navbar-icons glyphicon-user"></span>user10112</h3></div> <!-- ensure username is max 15 characters long -->
            </div>

            <ul class="sidebarOptions">
                <a href="{{ url("/")}}"><li class="dashboardTile navItem"><h4><span class="glyphicon navbar-icons glyphicon-dashboard"></span>Dashboard</h4></li></a>
                @if (Auth::check())
                    <a href="{{ url("account") }}"> <li class="portfolioTile navItem"><h4><span class="glyphicon glyphicon-book"></span>Portfolio</h4></li></a>
                @endif
                {{--<li class="portfolioTile"><h4>Portfolio</h4></li>--}}
                <a href="{{ url("leader")}}"><li class="leaderboardTile navItem"><h4><span class="glyphicon navbar-icons glyphicon-king"></span>Leaderboard</h4></li></a>
                <a href="{{ url("market")}}"><li class="marketTile navItem"><h4><span class="glyphicon navbar-icons glyphicon-stats"></span>Market</h4></li></a>
                <a href="{{ url("asxList")}}" class="btn btn-info navItem" role="button">Link Button</a>
                {{--<li class="leaderboardTile"><h4>Leaderboard</h4></li>--}}
                {{--<li class="marketTile"><h4>Market</h4></li>--}}
                @if (Route::has('login'))

                    @if (Auth::check())
                        <a href="{{ url('auth/logout') }}"><li><h4>Logout</h4></li></a>
                    @else
                        <a href="{{ url('/login') }}"><li><h4>Login</h4></li></a>
                        <a href="{{ url('/register') }}"><li><h4>Register</h4></li></a>

                    @endif

                @endif
            </ul>

            <div class="row-fluid sidebarBottom">
                <div class="col-lg-1 col-md-1 col-md-offset-1 col-lg-offset-1 sidebarBottomContainer"><button class="btn btn-default" ><a href="{{ url("settings") }}">Settings</a></button></div>
                @if (Auth::check())
                <div class="col-lg-1 col-lg-offset-5 col-md-offset-5 col-md-1 sidebarBottomContainer"><button class="btn-danger btn-logout">Log Out</button></div>
                @endif
            </div>
        </div>
    </div>
</div>




{{--<ul>--}}
    {{--<li><a href="{{ url("/")}}">Home</a></li>--}}
    {{--@if (Auth::check())--}}
    {{--<li><a href="{{ url("account") }}">Account</a></li>--}}
    {{--@endif--}}
    {{--<li><a href="{{ url("stock") }}">Stocks</a></li>--}}
    {{--<li><a href="{{ url("leader") }}">Leaderboard</a></li>--}}
    {{--<li><a href="{{ url("market") }}">Marketplace</a></li>--}}
    {{--@if (Route::has('login'))--}}

            {{--@if (Auth::check())--}}
                {{--<li><a href="{{ url('auth/logout') }}">Logout</a></li>--}}
            {{--@else--}}
                {{--<li><a href="{{ url('/login') }}">Login</a></li>--}}
                {{--<li><a href="{{ url('/register') }}">Register</a></li>--}}
            {{--@endif--}}

    {{--@endif--}}

{{--</ul>--}}