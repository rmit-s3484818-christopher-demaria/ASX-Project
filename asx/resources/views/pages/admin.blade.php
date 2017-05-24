@extends('layouts.master')
@section('title')
    Admin
@stop
@section('body')
    <?php
    $users = DB::table('users')->get();
    ?>
    <div class="navbarMargin">
        <div class="container-fluid">
            <div class="container-fluid">
                <div>
                    <h2 class="pageHeading">Admin</h2>
                    <table>
                        <tr>
                            <td>Username</td>
                            <td align="right">Ban</td>
                        </tr>
                    @foreach($users as $user)
                            <tr>
                                <td>
                                    <a href = "{{ route('passUserProfile', [$user->name]) }}">
                                        {{$user->name}}
                                    </a>
                                </td>
                                <td><button type="button" class="btn btn-danger">Ban</button></td>
                            </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
