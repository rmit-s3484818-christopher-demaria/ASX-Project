
@extends('layouts.master')
@section('title')
    Leader Board
@stop
@section('body')
    <h1 class="headers">Leader Board Page</h1>

 <?php $users = DB::table('users')->orderBy('money', 'desc')->get(); ?>

    <table class="leaderboard">
        <caption>Overall Leaders</caption>
        <tr>
            <th>Ranking</th>
            <th>Name</th>
            <th>Score(networth)</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <th> {{ $loop->iteration }} </th>
                <th> {{ $user->name }} </th>
                <th> ${{ number_format($user->money, 2) }} </th>
            </tr>
        @endforeach
    </table>

@endsection