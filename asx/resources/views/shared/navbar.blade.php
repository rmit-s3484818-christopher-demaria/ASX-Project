<!-- NAV BAR - Generic sticky navbar, improvements will be made later -->
<ul>
    <li><a href="{{ url("/")}}">Home</a></li>
    <li><a href="{{ url("account") }}">Account</a></li>
    <li><a href="{{ url("stock") }}">Stocks</a></li>
    @if (Route::has('login'))

            @if (Auth::check())
            @else
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
            @endif

    @endif

</ul>