@extends('layouts.master')
@section('title')
    Admin
@stop
@section('body')
    <?php
    $userID = Auth::id();

    if(isset($searchTerm)) //displays all stocks on first load, or loads stocks matching the users search term if they searched
    {
        $users = DB::table('users')->orderBy('name', 'asc')->where('name', 'LIKE', '%'.$searchTerm.'%')->paginate(15);
    }else{
        $users = DB::table('users')->orderBy('name', 'asc')->paginate(15);
    }

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

                                <form role ="form" method="POST" action="{{ route('searchUser') }}"> <!-- Takes users search input -->
                                    <span class="input-group-btn">
                            <input type="text" class="form-control searchBar" name ="searchTerm" id = "searchTerm" placeholder="Find a company by symbol or name...">
                            <button class="btn btn-primary searchBar" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                              </span>
                                </form>

                                <form role ="form" method="POST" action="{{ route('searchUser') }}"> <!-- Resets the search term -->
                                    <input type="hidden" class="form-control searchBar" name ="searchTerm" id = "searchTerm" value="">
                                    <button class="btn btn-primary searchBar" type="submit"><span></span>Reset</button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                    <table class="leader-table table-striped table table-responsive adminUserTable">
                        <tr class="leader-headings info">
                            <td align="left">Username</td>
                            <td align="left">ID</td>
                            <td align="right">Ban</td>
                        </tr>
                        @foreach($users as $user)
                            @if($user->id != $userID)
                            <tr>
                                <td>
                                    <a href = "{{ route('passUserProfile', [$user->id]) }}">
                                        {{$user->name}}
                                    </a>
                                </td>
                                <td align="left"> {{$user->id}} </td>
                                <td align="right"><form method="POST" action="admin/ {{ $user->id }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form></td>
                            </tr>
                            @endif
                        @endforeach

                    </table>
                            <div class ="paginateMarket"> {{ $users->links() }} </div> <!-- Paginate ad on that automates page system -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
