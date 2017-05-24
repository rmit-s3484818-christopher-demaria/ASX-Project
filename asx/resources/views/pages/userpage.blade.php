@extends('layouts.master')
@section('title')
    User page
@stop
@section('body')

    <?php $userName = DB::table('users')->where('name', $user)->first();

    ?>

    <div class="navbarMargin">
        <div class="container-fluid">
            <div class="container-fluid">
                <div>
                    <h2 class="pageHeading">{{ $userName->name }}'s Profile</h2>
                    <hr>
                </div>
            </div>
        </div>


@endsection
