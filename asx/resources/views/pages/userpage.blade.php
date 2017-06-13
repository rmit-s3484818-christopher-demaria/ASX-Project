@extends('layouts.master')
@section('title')
    User page
@stop
@section('body')

    <?php
    $userID = DB::table('users')->where('id', $user)->first();
    $transactions = DB::table('transactions')->where('user_id', $userID->id)->orderby('created_at', 'desc')->paginate(8);
    ?>

    <div class="navbarMargin">
        <div class="container-fluid">
            <div class="container-fluid">
                <div>
                    <h2 class="pageHeading">{{ $userID->name }}'s Profile</h2>
                    <hr>
                </div>
            </div>
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
                <div class ="paginate"> {{ $transactions->links() }} </div>
            </h3>
        </div>
    </div>

@endsection
