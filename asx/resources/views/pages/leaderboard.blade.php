
@extends('layouts.master')
@section('title')
    Leader Board
@stop
@section('body')
 <?php $users = DB::table('users')->orderBy('money', 'desc')->get(); ?>
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
                                <td>Name</td>
                                <td align="right">Score(networth)</td>
                            </tr>
                            @foreach ($users as $user)
                                <tr>
                                    <td align="center"> {{ $loop->iteration }} </td>
                                    <td> {{ $user->name }} </td>
                                    <td align="right"> ${{ number_format($user->money, 2) }} </td>
                                </tr>
                            @endforeach
                        </table>


                </div>
            </div>
        </div>
    </div>


@endsection