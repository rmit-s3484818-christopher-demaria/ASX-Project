
@extends('layouts.master')
@section('title')
    Leader Board
@stop
@section('body')
 <?php
 $users = DB::table('users')->get();
 $rankings = DB::table('portfolio')->orderBy('netWorth', 'desc')->paginate(25); //gets all the portfolios from the database and orders them from highest profit to lowest
 ?>
    <div class="navbarMargin">
        <div class="container-fluid">
            <div class="container-fluid">
                <div>
                    <h2 class="pageHeading">Leaderboard</h2>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="dash-content-wrapper">
                    <div class="row">

                        <table class="leader-table table-striped table table-responsive tableSmall">
                            <tr class="leader-headings info">
                                <td align="center" class="ranking-col">Ranking</td>
                                <td>Username</td>
                                <td align="right">Profit</td>
                            </tr>

                            <!-- Loops through the portfolios and displays each one in the table -->
                            @foreach ($rankings as $ranking)
                                <tr>
                                    <td align="center"><strong>#{{ $loop->iteration }}</strong></td>
                                    <td>
                                        @foreach($users as $user)
                                            @if($user->id == $ranking->user_id)
                                                {{ $user->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td align="right"> {{ number_format($ranking->netWorth, 2) }} </td>
                                </tr>
                            @endforeach
                        </table>
                        <div class ="paginateMarket"> {{ $rankings->links() }} </div> <!-- Paginate ad on that automates page system -->
                </div>
            </div>
        </div>
    </div>
    </div>


@endsection