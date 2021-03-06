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
    Home
@stop
@section('body')

    <?php
    $userID = Auth::id();
    $rankings = DB::table('portfolio')->orderBy('netWorth', 'desc')->get();
    $users = DB::table('portfolio')->where('user_id', $userID)->first();
    $userDetails = DB::table('users')->where('id', $userID)->first();
    $numberOfStocks = DB::table('owned_stocks')->where('user_id', $userID)->sum('number');
    $watchlist = DB::table('watchlist')->where('user_id', $userID)->paginate(5);
    $stocks = DB::table('stocks')->orderBy('symbol', 'asc');
    ?>

    <div class="navbarMargin">
        <div class="container-fluid">
            <div class="container-fluid">
                <div>
                    <h2 class="pageHeading"> {{ $userDetails->name }}'s Dashboard</h2>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container">
                <div class="dash-content-wrapper">
                    <div class="row">

                        <div class=" col-lg-3 col-md-4 col-sm-8 dash-content-tile col-md-offset-1 col-lg-offset-0 col-sm-offset-1 home">
                            <div>
                                <h1 class="dashIcons"><span class=" dashBorder glyphicon glyphicon-king"></span></h1>
                            </div>
                            <h1 class="dashboardContainers">
                                @foreach ($rankings as $ranking)
                                    @if ($ranking->user_id == $userID)
                                        #{{ $loop->iteration }}
                                    @endif
                                @endforeach
                            </h1>
                            <div class="col-lg-12 col-md-12 dash-content-link">
                                <h4 class="dash-content-link-text">Leaderboard Ranking</h4>

                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-8 dash-content-tile col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
                            <div>
                                <h1 class="dashIcons"><span class=" dashBorder glyphicon glyphicon-piggy-bank"></span></h1>
                            </div>
                            <h2 class="dashboardContainers"> ${{ number_format($users->money, 2) }} </h2>
                            <div class="col-lg-12 col-md-12 dash-content-link">
                                <h4 class="dash-content-link-text">Financial Position</h4>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-8 dash-content-tile 1 col-md-offset-1 col-sm-offset-1">
                            <div>
                                <h1 class="dashIcons"><span class=" dashBorder glyphicon glyphicon-eye-open"></span></h1>
                            </div>
                            <div class="text-center">
                                <a href={{url("watchlist")}}><button class="btn btn-primary watchlistBtn">Go to Watchlist <span class="glyphicon glyphicon-arrow-right"></span></button></a>
                            </div>
                            <div class="col-lg-12 col-md-12 dash-content-link">
                                <h4 class="dash-content-link-text">Watchlist</h4>
                            </div>

                        </div>


                    </div>


                    <div class="col-lg-9 col-lg-offset-1 dashbottom-tile text-center">
                        <h4 class="dash-text-bottom">Total shares owned: {{ $numberOfStocks }}</h4>
                    </div>
 <!--                 <div class="col-lg-9 col-lg-offset-1 dashbottom-tile text-center">
                        <h4 class="dash-text-bottom">Total value of owned stocks:</h4>
                    </div>
                    <div class="col-lg-9 col-lg-offset-1 dashbottom-tile text-center">
                        <h4 class="dash-text-bottom">Average price of owned stocks: </h4>
                    </div> -->

                </div>
            </div>
        </div>
                 <div class="dash-bottom-foot"></div>
    </div>
@endsection