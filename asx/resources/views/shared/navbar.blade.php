<!-- NAV BAR - Generic sticky navbar, improvements will be made later -->
<ul>
    <li><a href="{{ url("/")}}">Home</a></li>
    @if (Auth::check())
    <li><a href="{{ url("account") }}">Account</a></li>
    @endif
    <li><a href="{{ url("stock") }}">Stocks</a></li>
    <li><a href="{{ url("leader") }}">Leaderboard</a></li>
    <li><a href="{{ url("market") }}">Marketplace</a></li>
    @if (Route::has('login'))

            @if (Auth::check())
                <li><a href="{{ url('auth/logout') }}">Logout</a></li>
            @else
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
            @endif

    @endif

</ul>