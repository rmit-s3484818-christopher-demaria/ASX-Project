
@extends('layouts.master')
@section('title')
    Account
@stop
@section('body')
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
            <div class="col-lg-3 portfolio-rank-tile">
                <h1>Ranking 1st</h1>
            </div>
            <div class="col-lg-5 col-lg-offset-4 portfolio-cashbalance-tile">
                <h1>Cash Balance: <strong>$1,002,159</strong></h1>
            </div>

            <div class="col-lg-10 col-lg-offset-1 portfolio-tile portfolio-body-top-tile">
                <h1 class="portfolio-options">All Shares Held</h1>
                <div class="col-lg-10 col-lg-offset-1 allshares_info">
                    <h2>Info will be put in here</h2>
                </div>
            </div>
            <div class="col-lg-10 col-lg-offset-1 portfolio-tile">
                <h1 class="portfolio-options">Recently Purchased Shares</h1>
                <div class="col-lg-10 col-lg-offset-1 allshares_info">
                    <h2>Info will be put in here</h2>
                </div>
            </div>
            <div class="col-lg-10 col-lg-offset-1 portfolio-tile">
                <h1 class="portfolio-options">My Transactions</h1>
                <div class="col-lg-10 col-lg-offset-1 allshares_info">
                    <h2>Info will be put in here</h2>
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