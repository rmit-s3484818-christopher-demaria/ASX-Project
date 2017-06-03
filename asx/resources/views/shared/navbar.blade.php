<!-- NAV BAR - Generic sticky navbar, improvements will be made later -->

    <!-- Sidebar -->
    <div class="sidebarNav">
        <?php
        $userID = Auth::id();
        $userDetails = DB::table('users')->where('id', $userID)->first();
        ?>
        {{--<div class="row-fluid">--}}
            {{--<div class="row-fluid playerContainer">--}}
                {{--<div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1 playerTile"><span class="glyphicon navbar-icons glyphicon-user"></span><h5>user10112</h5></div> <!-- ensure username is max 15 characters long -->--}}
            {{--</div>--}}
        {{--</div>--}}
        <ul class="playerContainer">
            <li class="playerTile navItem"><span class="glyphicon navbar-icons glyphicon-user"></span><h4 class="sideBarText">{{ $userDetails->name }}</h4></li>
        </ul>
            <ul class="sidebarOptions">

                <a href="{{ url("/")}}"><li class="dashboardTile navItem"><span class="glyphicon navbar-icons glyphicon-dashboard"></span><h4 class="sideBarText">Dashboard</h4></li></a>
                @if (Auth::check())
                    <a href="{{ url("account")}}"><li class="leaderboardTile navItem"><span class="glyphicon navbar-icons glyphicon-book"></span><h4 class="sideBarText">Portfolio</h4></li></a>
                @endif
                {{--<li class="portfolioTile"><h4>Portfolio</h4></li>--}}
                <a href="{{ url("leader")}}"><li class="leaderboardTile navItem"><span class="glyphicon navbar-icons glyphicon-king"></span><h4 class="sideBarText">Rankings</h4></li></a>
                <a href="{{ url("market")}}"><li class="marketTile navItem"><span class="glyphicon navbar-icons glyphicon-stats"></span><h4 class="sideBarText">Market</h4></li></a>
                <a href="{{ url("friends")}}"><li class="marketTile navItem"><span class="glyphicon navbar-icons glyphicon-stats"></span><h4 class="sideBarText">Friends</h4></li></a>

                {{--<a href="{{ url("asxList")}}" class="btn btn-info navItem" role="button">Link Button</a>--}}

                {{--@if (Route::has('login'))--}}

                    {{--@if (Auth::check())--}}
                        {{--<a href="{{ url('auth/logout') }}"><li><h4 class="sideBarText">Logout</h4></li></a>--}}
                    {{--@else--}}
                        {{--<a href="{{ url('/login') }}"><li><h4 class="sideBarText">Login</h4></li></a>--}}
                        {{--<a href="{{ url('/register') }}"><li><h4 class="sideBarText">Register</h4></li></a>--}}

                    {{--@endif--}}

                {{--@endif--}}
            </ul>

            <div class="row-fluid sidebarBottom ">
                <ul class="sidebarOptions">
                    <a href="{{ url("settings")}}"><li class=" bottomNav navItem"><span class="glyphicon navbar-icons glyphicon-info-sign"></span><h4 class="sideBarText">FAQ's</h4></li></a>
                    <br>
                    <a href="{{ url("auth/logout")}}"><li class=" logoutNav navItem"><span class="glyphicon navbar-icons glyphicon-off"></span><h4 class="sideBarText">Logout</h4></li></a>
                </ul>
                {{--<div class="col-lg-1 col-md-1 col-md-offset-1 col-lg-offset-1 sidebarBottomContainer"><button class="btn btn-default" ><a href="{{ url("settings") }}">Settings</button></div>--}}
{{--            @if (Auth::check())
           <div class="col-lg-1 col-lg-offset-5 col-md-offset-5 col-md-1 sidebarBottomContainer"><button class="btn-danger btn-logout">Log Out</button></div>
             @endif --}}

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