@extends('layouts.master')
@section('title')
    Watchlist
@stop
@section('body')
    <?php
            $userID = Auth::id();
            $watchlist = DB::table('watchlist')->where('user_id', $userID)->orderBy('stock_symbol', 'asc')->paginate(20);
    ?>
    <div class="navbarMargin">
        <div class="container-fluid">
            <div>
                <table class="leader-table table-striped table table-responsive tableSmall">
                    <tr class="leader-headings info">
                        <td align="center" class="ranking-col">Company Symbol</td>
                        <td>Current Price</td>
                        <td align="center">Percentage Change</td>
                        <td align="center">Expected Price</td>
                        <td align="center">Date Added</td>
                        <td align="centre">Date Expired</td>
                    </tr>
                @foreach ($watchlist as $watchlists)  <!-- Loops through the selected stocks -->
                    <tr>
                        <td align="center"><strong> {{$watchlists->stock_symbol}} </strong></td> <!-- Opens up the buy page with the selected symbol -->
                        <td>${{ $watchlists->curr_stock_price }}</td>
                        <td align="center"> %{{$watchlists->wanted_price}}</td>
                        <td align="center">${{$watchlists->expected_price}}</td>
                        <td align="center">{{$watchlists->date_added}}</td>
                        <td align="center">{{$watchlists->date_expire}}</td>
                    </tr>
                    @endforeach
                </table>
                <div class ="paginateMarket"> {{ $watchlist->links() }} </div> <!-- Paginate ad on that automates page system -->
                <hr>
            </div>

        </div>
    </div>


@endsection