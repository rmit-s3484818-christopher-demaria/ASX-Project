@extends('layouts.landing')

@section('body')

    <div class="container">
        <div>
            <h1 class="landingHeading">ASX Master</h1>
            <hr>
        </div>
    </div>
    <!-- login form -->
    <div class="container">
        <div class="row createNewAccountForm">
            <h1 class="logcreateHeading">Create an Account</h1>

            <div class="col-lg-offset-3 col-md-offset-2  col-sm-offset-1 col-lg-6 col-md-8 col-sm-10">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                    <!-- Make sure to come back and include the success/failed glyphs on toggle -->
                    <h3>Name</h3>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="e.g Joe Citizen" required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif

                    <h3>Email</h3>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                    {{--<input class="form-control" type="email" placeholder="you@example.com">--}}

                    <h3>Password</h3>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                    {{--<input class="form-control" type="password" placeholder="Password">--}}

                    <h3>Confirm Password</h3>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Re-type Password" required>
                    {{--<input class="form-control" type="password" placeholder="Re-type Password">--}}

                    <div class="col-sm-6 col-sm-offset-3">
                        <button type="submit" class="btn-warning btn-login">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Login alternate options -->
        <div class="row">
            <div>
                <h4 class="landingLoginLink">Already have an account? <a href="{{ url("login") }}">Log In</a></h4>
            </div>

        </div>

    </div>

{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Register</div>--}}
                {{--<div class="panel-body">--}}
                    {{--<form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
                            {{--<label for="name" class="col-md-4 control-label">Name</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}

                                {{--@if ($errors->has('name'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                            {{--<label for="password" class="col-md-4 control-label">Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Register--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
