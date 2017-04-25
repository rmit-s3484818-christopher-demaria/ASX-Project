
@extends('layouts.master')
@section('title')
    Leader Board
@stop
@section('body')
 <?php
 $users = DB::table('users')->get();
 $rankings = DB::table('portfolio')->orderBy('netWorth', 'desc')->get();
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

                        <table class="leader-table table-striped table table-responsive">
                            <tr class="leader-headings info">
                                <td align="center" class="ranking-col">Ranking</td>
                                <td>Username</td>
                                <td align="right">Score/Net Worth</td>
                            </tr>
                            @foreach ($rankings as $ranking)
                                <tr>
                                    <td align="center"><strong>{{ $loop->iteration }}</strong></td>
                                    <td>
                                        @foreach($users as $user)
                                            @if($user->id == $ranking->user_id)
                                                {{ $user->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td align="right"> {{ number_format($ranking->money, 2) }} </td>
                                </tr>
                            @endforeach
                        </table>


                </div>
            </div>
        </div>
    </div>
    </div>


@endsection