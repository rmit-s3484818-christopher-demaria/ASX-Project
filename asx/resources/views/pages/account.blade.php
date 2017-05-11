@extends('layouts.master')
@section('title')
    Account
@stop
@section('body')

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

    $userID = Auth::id();
    $rankings = DB::table('portfolio')->orderBy('netWorth', 'desc')->get();
    $users = DB::table('portfolio')->where('user_id', $userID)->first();
    $ownedStocks = DB::table('owned_stocks')->where('user_id', $userID)->get();
    $stockPrices = DB::table('stocks')->get();
    $transactions = DB::table('transactions')->where('user_id', $userID)->get();
    ?>

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
                <div class="col-lg-3 col-lg-offset-1 portfolio-rank-tile">
                    <h1>
                        @foreach ($rankings as $ranking)
                            @if($userID == $ranking->user_id)
                                Rank #{{ $loop->iteration }}
                            @endif
                        @endforeach
                    </h1>
                </div>
                <div class="col-lg-5 col-lg-offset-2 portfolio-cashbalance-tile">
                    <h1>Cash Balance: ${{ number_format($users->money, 2) }} </h1>
                </div>

                <div class="col-lg-10 col-lg-offset-1 portfolio-tile portfolio-body-top-tile">
                    <h1 class="portfolio-options">All Shares Held</h1>
                    <div class="col-lg-10 col-lg-offset-1 allshares_info">
                        <h3 class="tableHeadingPortfolio">
                            <table class="leader-table table-striped table table-responsive">
                                <tr class="leader-headings info">
                                    <td align="center" class="ranking-col">Company Symbol</td>
                                    <td>Shares Owned</td>
                                    <td>Share worth</td>
                                    <td>Total worth</td>
                                </tr>
                                @foreach ($ownedStocks as $ownedStock)
                                    <tr>
                                        <td align="center"><strong><a href = "{{ route('passSymbolSell', [$ownedStock->stock_symbol, $ownedStock->number]) }}"> {{$ownedStock->stock_symbol}} </a> </strong></td>
                                        <td>{{ $ownedStock->number }}</td>
                                        <td>
                                            @foreach ($stockPrices as $stockPrice)
                                                @if ($stockPrice->symbol == $ownedStock->stock_symbol)
                                                    ${{$stockPrice->price}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td> 
                                            @foreach ($stockPrices as $stockPrice)
                                                @if ($stockPrice->symbol == $ownedStock->stock_symbol)
                                                   $@php
                                                        $test = $stockPrice->price*$ownedStock->number;
                                                    echo $test;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-10 col-lg-offset-1 portfolio-tile">
                    <h1 class="portfolio-options">Recently Purchased Shares</h1>
                    <div class="col-lg-10 col-lg-offset-1 allshares_info">
                        <h3 class="tableHeadingPortfolio">
                            <table class="leader-table table-striped table table-responsive">
                                <tr class="leader-headings info">
                                    <td align="center" class="ranking-col">Company Symbol</td>
                                    <td>Shares Owned</td>
                                    <td align="left">Price</td>
                                </tr>

                            </table>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-10 col-lg-offset-1 portfolio-tile">
                    <h1 class="portfolio-options">My Transactions</h1>
                    <div class="col-lg-10 col-lg-offset-1 allshares_info">
                        <h3 class="tableHeadingPortfolio">
                            <table class="leader-table table-striped table table-responsive">
                                <tr class="leader-headings info">
                                    <td align="center" class="ranking-col">Symbol</td>
                                    <td>Type</td>
                                    <td>Quantity</td>
                                    <td>Total (after fees)</td>
                                    <td>Date</td>
                                </tr>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td align="center"> {{ $transaction->stock_symbol }} </td>
                                        <td> @php
                                                if( $transaction->type == 0 )
                                                {
                                                   echo 'Buy';
                                                }
                                                else
                                                {
                                                   echo 'Sell';
                                                }
                                            @endphp
                                        </td>
                                        <td> {{ $transaction->number }}</td>
                                        <td> ${{ $transaction->price }}</td>
                                        <td>Placeholder</td>
                                    </tr>
                                @endforeach

                            </table>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-10 col-lg-offset-1 portfolio-tile">
                    <h1 class="portfolio-options">My Trading Accounts</h1>
                    <div class="col-lg-10 col-lg-offset-1 allshares_info">
                        <h2>Info will be put in here</h2>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
