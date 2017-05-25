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
                    <hr>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="input-group" >
                                <input type="text" class="form-control searchBar"   placeholder="Find players">
                                <span class="input-group-btn">
                                <button class="btn btn-primary searchBar" type="button"><span class="glyphicon glyphicon-search"></span></button>
                                </span>
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                    </div>

                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                    <table class="leader-table table-striped table table-responsive adminUserTable">
                        <tr class="leader-headings info">
                            <td align="left">Username</td>
                            <td align="right">Ban</td>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <a href = "{{ route('passUserProfile', [$user->name]) }}">
                                        {{$user->name}}
                                    </a>
                                </td>
                                <td align="right"><button type="button" class="btn btn-danger">Ban</button></td>
                            </tr>
                        @endforeach

                    </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
