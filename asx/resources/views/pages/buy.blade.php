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
    Buy
@stop
@section('body')

    <script src="jquery-3.2.0.min.js"></script>

    <?php $stock = DB::table('stocks')->where('symbol', $symbol)->first();
    $userID = Auth::id();
    $users = DB::table('portfolio')->where('user_id', $userID)->first();
    ?>

<div class="navbarMargin">
    <div class="container-fluid">
        <div class="container-fluid">
            <div>
                <h2 class="pageHeading"><a class="backIcon"><span class="glyphicon glyphicon-menu-left pull-left"></span></a>Buy</h2>
                <hr>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row company-buysell">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h1>{{ $stock->name }} <span>{{$symbol}}</span></h1>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h1>Balance: ${{ number_format($users->money, 2) }}</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-8 col-sm-8 col-lg-offset-4  col-sm-offset-2">
            <form role ="form" method="POST" action="{{ route('buyStock') }}">

                <h3>Share Price</h3>
                <input class="form-control" type="text" value = "${{ $stock->price }}" readonly>

                <h3>Quantity</h3>
                <input name ="quantity" class="form-control" type="number" id = "quantity" min="1">

                <h3>Sub Total</h3>
                <input name ="price" class="form-control" type="number" id = "subTotal" readonly>

                <input name="symbol" class = "form-control" type = "hidden" id = "symbol" value = "{{ $symbol }}">
                <input name="userID" class = "form-control" type = "hidden" id = "symbol" value = "{{ $userID }}">

                <button class="btn btn-success confirmBtn"><span class="glyphicon glyphicon-ok-circle" type = "Submit"></span><h3 class="buySellBtns">Confirm</h3></button>

            </form>

            <button class="btn btn-danger cancelX"><span class="glyphicon glyphicon-remove-circle"></span><h3 class="buySellBtns">Cancel</h3></button>

            <script>
                var input = document.getElementById('quantity');
                input.onchange = function()
                {
                    var price = {{ $stock->price }};
                    var calc = price*input.value;
                    document.getElementById('subTotal').value = calc;
                }
            </script>

        </div>
    </div>
<br>


</div>


@endsection