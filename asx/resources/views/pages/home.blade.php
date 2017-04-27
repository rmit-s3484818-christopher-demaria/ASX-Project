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
    ?>

    <div class="navbarMargin">
        <div class="container-fluid">
            <div class="container-fluid">
                <div>
                    <h2 class="pageHeading">username's Dashboard</h2>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container">
                <div class="dash-content-wrapper">
                    <div class="row">

                        <div class="col-lg-3 col-md-4 col-sm-8 dash-content-tile col-md-offset-1 col-lg-offset-0 col-sm-offset-1">
                            <p>
                                @foreach ($rankings as $ranking)
                                    @if($userID == $ranking->user_id)
                                       Ranked: {{ $loop->iteration }}
                                    @endif
                                @endforeach
                            </p>
                            <div class="col-lg-12 col-md-12 dash-content-link">
                                <h4 class="dash-content-link-text">Leaderboard Ranking</h4>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-8 dash-content-tile col-lg-offset-1 col-md-offset-1  col-sm-offset-1">
                            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
                            <div class="col-lg-12 col-md-12 dash-content-link">
                                <h4 class="dash-content-link-text">Best Share</h4>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-8 dash-content-tile 1 col-md-offset-1 col-sm-offset-1">
                            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
                            <div class="col-lg-12 col-md-12 dash-content-link">
                                <h4 class="dash-content-link-text">Worst Share</h4>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-4 col-sm-8 dash-content-tile col-md-offset-1 col-lg-offset-0 col-sm-offset-1">
                            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
                            <div class="col-lg-12 col-md-12 dash-content-link">
                                <h4 class="dash-content-link-text">Best Company Share in Market</h4>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-8 dash-content-tile col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
                            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
                            <div class="col-lg-12 col-md-12 dash-content-link">
                                <h4 class="dash-content-link-text">Worst Company Share in Market</h4>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-8 dash-content-tile col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
                            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
                            <div class="col-lg-12 col-md-12 dash-content-link">
                                <h4 class="dash-content-link-text">My Watchlist</h4>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection