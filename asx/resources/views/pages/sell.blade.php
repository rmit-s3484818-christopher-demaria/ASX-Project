<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 24/03/2017
 * Time: 4:36 PM
 **/
?>
@extends('layouts.master')
@section('title')
    Sell
@stop
@section('body')

    <script src="jquery-3.2.0.min.js"></script>

    <?php
    $stock = DB::table('stocks')->where('symbol', $symbol)->first();   //Gets the stock info from the selected stock
    $userID = Auth::id();
    $users = DB::table('portfolio')->where('user_id', $userID)->first();    //Gets the users portfolio information
    $maxSell = DB::table('owned_stocks')->where('user_id', $userID)->where('stock_symbol', $symbol)->first();  //Gets how many of the selected stock the user owns
    $transactions = DB::table('transactions')->where('user_id', $userID)->orderby('created_at', 'desc')->get(); //Gets the transactions by the user
    ?>


    <div class="navbarMargin">
        <div class="container-fluid">
            <div class="container-fluid">
                <div>
                    <h2 class="pageHeading"><a class="backIcon"><span class="glyphicon glyphicon-menu-left pull-left" onclick="goBack()"></span></a>Sell</h2>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row company-buysell">
                <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                    <h1> Company Name </h1>  <span class ="buyPageInfo"> {{ $stock->name }} </span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                    <h1> Stock Symbol </h1>  <span class ="buyPageInfo"> {{ $stock->symbol }} </span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                    <h1>Balance </h1>  <span class ="buyPageInfo"> ${{ number_format($users->money, 2) }} </span> <!-- Displays the users balance in money format -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-8 col-sm-8 col-lg-offset-4  col-sm-offset-2">
                <form role ="form" method="POST" action="{{ route('sellStock') }}"> <!-- Sell form -->

                    <h3>Share Price</h3>
                    <input class="form-control" type="text" value = "${{ $stock->price }}" readonly> <!-- Shows the stocks current price -->

                    <h3>Quantity  /{{$maxSell->number}}</h3>
                    <input name ="quantity" class="form-control" type="number" id = "quantity" min="1" max="{{$maxSell->number}}"> <!-- Shows the max stock the user owns and doesnt let them sell more than they have -->
                    <h3>Sub Total (Includes $<span id = "fees">0</span> in fees )</h3> <!-- Shows the cost of fess and is updated automatically -->
                    <input name ="price" class="form-control" type="number" id = "subTotal" readonly> <!-- Displays the total cost of the transaction -->

                    <input name="symbol" class = "form-control" type = "hidden" id = "symbol" value = "{{ $symbol }}"> <!-- 2 hidden values that are passed with the form -->
                    <input name="userID" class = "form-control" type = "hidden" id = "symbol" value = "{{ $userID }}">

                    <button class="btn btn-success confirmBtn"><span class="glyphicon glyphicon-ok-circle" type = "Submit"></span><h3 class="buySellBtns">Confirm</h3></button>

                </form>

                <button class="btn btn-danger cancelX" onclick="goBack()"><span class="glyphicon glyphicon-remove-circle"></span><h3 class="buySellBtns">Cancel</h3></button>

                <script>

                    //Calculates and updates the subtotal and fees of the transaction
                    var input = document.getElementById('quantity');
                    input.onchange = function()
                    {

                        var price = {{ $stock->price }};
                        var calc = price*input.value;

                        var flatFee = 50;
                        var percentCharge = (1 / 100) * calc;
                        var fees = flatFee + percentCharge;

                        var totalCost = calc - fees.toFixed(2);
                        var fees2 = fees.toFixed(2);

                        document.getElementById('subTotal').value = totalCost;
                        document.getElementById('fees').innerHTML = fees2;
                    }

                    //Function to go back to the previous page
                    function goBack() {
                        window.history.back();
                    }
                </script>

            </div>

        </div>
        <br>

        <div class="container">
            <div class="row">
                <h3>You bought these shares for:</h3>

                <div class="col-lg-12 col-md-12">
                    <table class="leader-table table-striped table table-responsive tableBorder">
                        <tr class="leader-headings info">
                            <td align="center" class="ranking-col">Symbol</td>
                            <td>Type</td>
                            <td>Quantity</td>
                            <td>Single price</td>
                            <td>Total (after fees)</td>
                            <td>Date</td>
                        </tr>
                    @foreach ($transactions as $transaction) <!-- Loops through transactions -->
                    @if ($transaction->stock_symbol == $symbol) <!-- Checks if the transaction involves the current selected stock -->
                        <tr>
                            <td align="center"> {{ $transaction->stock_symbol }} </td>
                            <td> <!-- Checks if the transaction is 'buy' or 'sell' and prints out which one it is -->
                                @php
                                    if( $transaction->type == 0)
                                    {
                                       echo 'Buy';
                                    }
                                    elseif ( $transaction->type == 1)
                                    {
                                       echo 'Sell';
                                    }
                                @endphp
                            </td>
                            <td> {{ $transaction->number }}</td>
                            <td> ${{ $transaction->singlePrice }}</td>
                            <td>
                            @if( $transaction->type == 0 ) <!-- Checks if the transaction is 'buy' or 'sell' and prints out '+' or '-' to show if the user spent or gained this money -->
                                - ${{ $transaction->price }}
                                @endif

                                @if( $transaction->type == 1 )
                                    + ${{ $transaction->price }}
                                @endif
                            </td>
                            <td> {{ $transaction->created_at }} </td>
                        </tr>
                        @endif
                        @endforeach
                    </table>
                </div>

            </div>

        </div>


    </div>


@endsection