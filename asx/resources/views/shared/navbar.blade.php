<!-- NAV BAR - Generic sticky navbar, improvements will be made later -->
<<<<<<< HEAD
<div class="sidebarNav">
=======
<ul>
    <li><a href="{{ url("/")}}">Home</a></li>
    <li><a href="{{ url("account") }}">Account</a></li>
    <li><a href="{{ url("stock") }}">Stocks</a></li>
    <li><a href="{{ url("leader") }}">Leaderboards</a></li>
    <li><a href="{{ url("market") }}">Market Place</a></li>
    @if (Route::has('login'))
>>>>>>> origin/master

    <div class="row-fluid">
        <div class="row-fluid playerContainer">
            <div class="col-lg-1 col-md-1 col-lg-offset-1 col-md-offset-1 playerTile"><h3>Icon</h3></div>
            <div class="col-lg-8 col-md-8 col-lg-offset-1 col-md-offset-1 playerTile"><h3>user10112</h3></div> <!-- ensure username is max 15 characters long -->
        </div>

        <ul class="sidebarOptions">
            {{--<li class="dashboardTile"><a href="{{ url("/")}}">Home</a></li>--}}
            {{--<li class="dashboardTile"><a href="{{ url("account") }}">Account</a></li>--}}
            {{--<li class="dashboardTile"><a href="{{ url("stock") }}">Stocks</a></li>--}}
            <li class="dashboardTile"><h4>Dashboard</h4></li>
            <li class="portfolioTile"><h4>Portfolio</h4></li>
            <li class="leaderboardTile"><h4>Leaderboard</h4></li>
            <li class="marketTile"><h4>Market</h4></li>
        </ul>

        <div class="row-fluid sidebarBottom">
            <div class="col-lg-1 col-md-1 col-md-offset-1 col-lg-offset-1 sidebarBottomContainer">Settings</div>
            <div class="col-lg-1 col-lg-offset-5 col-md-offset-5 col-md-1 sidebarBottomContainer"><button class="btn-danger btn-logout">Log Out</button></div>
        </div>
    </div>
</div>

{{--<ul>--}}
    {{--<li><a href="{{ url("/")}}">Home</a></li>--}}
    {{--<li><a href="{{ url("account") }}">Account</a></li>--}}
    {{--<li><a href="{{ url("stock") }}">Stocks</a></li>--}}
    {{--@if (Route::has('login'))--}}

            {{--@if (Auth::check())--}}
                {{--<li><a href="{{ url('auth/logout') }}">Logout</a></li>--}}
            {{--@else--}}
                {{--<li><a href="{{ url('/login') }}">Login</a></li>--}}
                {{--<li><a href="{{ url('/register') }}">Register</a></li>--}}
            {{--@endif--}}

    {{--@endif--}}

{{--</ul>--}}