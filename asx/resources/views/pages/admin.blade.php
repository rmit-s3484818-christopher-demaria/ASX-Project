@extends('layouts.master')
@section('title')
    Admin
@stop
@section('body')
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
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

                        <div class="col-lg-9 col-lg-offset-1 col-md-8 col-sm-6 col-md-offset-1 col-sm-offset-1">
                            <form role ="form" method="POST" action="{{ route('searchUser') }}"> <!-- Takes users search input -->
                                <div class="input-group">
                                    <input type="text" class="form-control searchBar" name ="searchTerm" id = "searchTerm" placeholder="Find a player...">
                                    <span class="input-group-btn">
                                <button class="btn btn-primary searchBar" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                </span>
                                </div>
                            </form>
                        </div>

                       <div class="col-lg-2 col-md-2 col-sm-2">
                           <form role ="form" method="POST" action="{{ route('searchUser') }}"> <!-- Resets the search term -->

                                <input type="hidden" class="form-control searchBar" name ="searchTerm" id = "searchTerm" value="">
                                <button class="btn btn-default searchBar" type="submit"><span></span>Reset</button>

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
