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
                'netWorth' => 0
            ]
        );
    }

    $userID = Auth::id();
    $rankings = DB::table('portfolio')->orderBy('netWorth', 'desc')->get();
    $users = DB::table('portfolio')->where('user_id', $userID)->first();
    $ownedStocks = DB::table('owned_stocks')->where('user_id', $userID)->get();
    $stockPrices = DB::table('stocks')->get();
    $transactions = DB::table('transactions')->where('user_id', $userID)->get();

    use Carbon\Carbon;
    $dayAgo = Carbon::today()->subWeek();
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

                <div class="col-lg-5 col-lg-offset-1 portfolio-tile portfolio-body-top-tile">
                    <h1 class="portfolio-options">All Shares Held</h1>
                    <div class="col-lg-10 col-lg-offset-1 allshares_info" id="portfolio-allshares" >
                        <h3 class="tableHeadingPortfolio">
                            <table class="leader-table table-striped table table-responsive tableBorder">
                                <tr class="leader-headings info">
                                    <td align="center" class="ranking-col">Symbol</td>
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
                        <div class="text-center">
                            <ul class="pagination ">
                                <li>
                                    <a href="#" aria-label="Previous"> First
                                        <span aria-hidden="true"></span>
                                    </a>
                                </li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                    <a href="#" aria-label="Next">
                                        <span aria-hidden="true" class="glyphicon glyphicon-chevron-right"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5  portfolio-tile portfolio-body-top-tile" id="port-recent-panel">
                    <h1 class="portfolio-options">Recently Purchased Shares</h1>
                    <div class="col-lg-10 col-lg-offset-1 allshares_info">
                        <h3 class="tableHeadingPortfolio">
                            <table class="leader-table table-striped table table-responsive tableBorder">
                                <tr class="leader-headings info">
                                    <td  align="center" class="ranking-col">Symbol</td>
                                    <td  align="center">Shares Owned</td>
                                    <td  align="center">Date</td>
                                @foreach ($transactions as $transaction)
                                    @if ($transaction->type == 0 && $transaction->created_at > $dayAgo)
                                    <tr>
                                        <td align="center"> {{ $transaction->stock_symbol }} </td>
                                        <td align="center"> {{ $transaction->number }} </td>
                                        <td align="center"> {{ $transaction->created_at }} </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </table>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-10 col-lg-offset-1 portfolio-tile tileBottom">
                    <h1 class="portfolio-options">My Transactions</h1>
                    <div class="col-lg-10 col-lg-offset-1 allshares_info">
                        <h3 class="tableHeadingPortfolio">
                            <table class="leader-table table-striped table table-responsive tableBorder">
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
                                        <td>
                                                @if( $transaction->type == 0 )
                                                   - ${{ $transaction->price }}
                                                @endif

                                                @if( $transaction->type == 1 )
                                                  + ${{ $transaction->price }}
                                                @endif
                                        </td>
                                        <td> {{ $transaction->created_at }} </td>
                                    </tr>
                                @endforeach

                            </table>
                        </h3>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
