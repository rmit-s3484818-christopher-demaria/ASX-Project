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

    <?php
    $stock = DB::table('stocks')->where('symbol', $symbol)->first();
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
                {{--Will updated accordingly to company chosen--}}
                <h1>{{ $stock->name }} <span>{{$symbol}}</span></h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-8 col-sm-8 col-lg-offset-4  col-sm-offset-2">
            <form>
                <h3>Share Price</h3>
                <input class="form-control" type="text" value = "{{ $stock->price }}" readonly>

                <h3>Quantity</h3>
                <input class="form-control" type="text">

                <h3>Sub Total</h3>
                <input class="form-control" type="text">

                {{--<h3>Cash Balance</h3>--}}
                {{--<input class="form-control" type="text">--}}
            </form>
        </div>
    </div>
<br>
    <div class="row">
        <div class="col-lg-4 col-md-8 col-sm-8 col-lg-offset-4  col-sm-offset-2">
            <button class="btn btn-success confirmBtn"><span class="glyphicon glyphicon-ok-circle"></span><h3 class="buySellBtns">Confirm</h3></button>
            <button class="btn btn-danger cancelX"><span class="glyphicon glyphicon-remove-circle"></span><h3 class="buySellBtns">Cancel</h3></button>
        </div>

    </div>

</div>


@endsection