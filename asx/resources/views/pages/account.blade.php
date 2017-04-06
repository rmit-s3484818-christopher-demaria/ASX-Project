
@extends('layouts.master')
@section('title')
    Account
@stop
@section('body')
    <h1 class="headers">Account Page</h1>
    <p><strong>Welcome {{ Auth::user()->name }}!</strong></p>
    <p><strong>Your account balance is: ${{ Auth::user()->money }}</strong></p>
    <p>This will be our account page</p>
    <p>Text added by andy as a test. Will be deleted</p>
@endsection