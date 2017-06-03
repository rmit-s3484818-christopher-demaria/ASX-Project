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

    <?php $stock = DB::table('stocks')->where('symbol', $symbol)->first();
    $userID = Auth::id();
    $users = DB::table('portfolio')->where('user_id', $userID)->first();
    $maxSell = DB::table('owned_stocks')->where('user_id', $userID)->where('stock_symbol', $symbol)->first();
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
                    <h1>Balance </h1>  <span class ="buyPageInfo"> ${{ number_format($users->money, 2) }} </span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-8 col-sm-8 col-lg-offset-4  col-sm-offset-2">
                <form role ="form" method="POST" action="{{ route('sellStock') }}">

                    <h3>Share Price</h3>
                    <input class="form-control" type="text" value = "${{ $stock->price }}" readonly>

                    <h3>Quantity  /{{$maxSell->number}}</h3>
                    <input name ="quantity" class="form-control" type="number" id = "quantity" min="1" max="{{$maxSell->number}}">
                    <h3>Sub Total (Includes $<span id = "fees">0</span> in fees )</h3>
                    <input name ="price" class="form-control" type="number" id = "subTotal" readonly>

                    <input name="symbol" class = "form-control" type = "hidden" id = "symbol" value = "{{ $symbol }}">
                    <input name="userID" class = "form-control" type = "hidden" id = "symbol" value = "{{ $userID }}">

                    <button class="btn btn-success confirmBtn"><span class="glyphicon glyphicon-ok-circle" type = "Submit"></span><h3 class="buySellBtns">Confirm</h3></button>

                </form>

                <button class="btn btn-danger cancelX" onclick="goBack()"><span class="glyphicon glyphicon-remove-circle"></span><h3 class="buySellBtns">Cancel</h3></button>

                <script>
                    var input = document.getElementById('quantity');
                    input.onchange = function()
                    {

                        var price = {{ $stock->price }};
                        var calc = price*input.value;

                        var flatFee = 50;
                        var percentCharge = (1 / 100) * calc;
                        var fees = flatFee + percentCharge;

                        var totalCost = calc - fees;

                        document.getElementById('subTotal').value = totalCost;
                        document.getElementById('fees').innerHTML = fees;
                    }
                    function goBack() {
                        window.history.back();
                    }
                </script>

            </div>
        </div>
        <br>


    </div>


@endsection