@extends('layouts.master')
@section('title')
    Account
@stop
@section('body')
    {{--<h1 class="headers">Account Page</h1>--}}
    {{--<p><strong>Welcome {{ Auth::user()->name }}!</strong></p>--}}

    {{--<p>This will be our account page</p>--}}
    {{--<p>Text added by andy as a test. Will be deleted</p>--}}



    <div class="navbarMargin">
        <div class="container-fluid">
            <div class="container-fluid">
                <div>
                    <h2 class="pageHeading">Portfolio</h2>
                    <hr>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row portfolio-body">
                <div class="col-lg-3 portfolio-rank-tile">
                    <h1>Rank #
                        <?php
                        $userID = Auth::id();
                        $rankings = DB::table('portfolio')->orderBy('netWorth', 'desc')->get();
                        ?>
                        @foreach ($rankings as $ranking)
                            @if($userID == $ranking->user_id)
                                {{ $loop->iteration }}
                            @endif
                        @endforeach
                    </h1>
                </div>
                <div class="col-lg-5 col-lg-offset-4 portfolio-cashbalance-tile">
                    <h1>Cash Balance: $
                        <?php
                        $userID = Auth::id();
                        $users = DB::table('portfolio')->where('user_id', $userID)->get();
                        ?>
                        @foreach ($users as $user)
                                 {{ number_format($user->money, 2) }}
                        @endforeach
                    </h1>
                </div>

                <div class="col-lg-10 col-lg-offset-1 portfolio-tile portfolio-body-top-tile">
                    <h1 class="portfolio-options">All Shares Held</h1>
                    <div class="col-lg-10 col-lg-offset-1 allshares_info">
                        <h2>Info will be put in here</h2>
                    </div>
                </div>
                <div class="col-lg-10 col-lg-offset-1 portfolio-tile">
                    <h1 class="portfolio-options">Recently Purchased Shares</h1>
                    <div class="col-lg-10 col-lg-offset-1 allshares_info">
                        <h2>Info will be put in here</h2>
                    </div>
                </div>
                <div class="col-lg-10 col-lg-offset-1 portfolio-tile">
                    <h1 class="portfolio-options">My Transactions</h1>
                    <div class="col-lg-10 col-lg-offset-1 allshares_info">
                        <h2>Info will be put in here</h2>
                    </div>
                </div>
                <div class="col-lg-10 col-lg-offset-1 portfolio-tile">
                    <h1 class="portfolio-options">My Trading Accounts</h1>
                    <div class="col-lg-10 col-lg-offset-1 allshares_info">
                        <h2>Info will be put in here</h2>
                        <?php
                        $userID = Auth::id();
                        $money = 1000000;
                        $portfolio = DB::table('portfolio')->where('user_id', $userID)->first();

                        if (!$portfolio)
                        {
                            DB::table('portfolio')->insert
                            (
                                [
                                    'user_id' => $userID,
                                    'ownedStocks' => 0,
                                    'money' => $money,
                                    'netWorth' => $money
                                ]
                            );
                        }
                        ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{--=======--}}
    {{--<h1 class="headers">Account Page</h1>--}}
    {{--<p><strong>Welcome {{ Auth::user()->name }}!</strong></p>--}}
    {{--<p>This will be our account page</p>--}}
    {{--<p>Text added by andy as a test. Will be deleted</p>--}}
    {{-->>>>>>> origin/master--}}
@endsection
