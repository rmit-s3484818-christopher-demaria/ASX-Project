@extends('layouts.master')
@section('title')
    Messages
@stop
@section('body')

    <?php
    $userID = Auth::id();

//    DB::table('messages')->insert
//    (
//        [
//            'sender_id' => $userID,
//            'receiver_id' => 14,
//            'message' => 'hi friend',
//            'money' => 77,
//            'read' => 0
//        ]
//    );

    $friends = DB::table('friends')->where('userID', $userID)->orwhere('friendID', $userID)->get();
    $users = DB::table('users')->get();
    ?>

    <div class="navbarMargin">
        <div class="container-fluid">
            <div class="container-fluid">
                <div>
                    <h2 class="pageHeading">Friends</h2>
                    <hr>
                </div>
            </div>
        </div>
        <div class = "sendRequestBox">
            <div class = "friendInstruction">
                Your User ID is: {{$userID}}<br>
            </div>
            <p class = "friendsHeader">Send friend request</p>
            <form role ="form" method="POST" action="{{ route('friendRequest') }}">
                <input name="friendID" class = "form-control" type="number" id = "friendID" min = "1" placeholder = "Enter your friends User ID here">
                <button class="btn btn-success confirmBtn friendButton"><span class="glyphicon glyphicon-ok-circle" type = "Submit"></span><h3 class="buySellBtns">Send</h3></button>
            </form>
        </div>


        <div class = "activeRequestsBox">
            <p class="friendsHeader">Active friend requests</p>
            <div class = "activeRequests">
            @foreach($friends as $friend)
                @if($friend->requestAccepted == 0)

                    @if($friend->userID != $userID)
                        <div class = "singleRequest">
                            <b>User ID:</b> {{ $friend->userID }}<br>
                            <b>User Name: </b>
                        @foreach($users as $user)
                            @if($user->id == $friend->userID)
                                {{ $user->name }}
                            @endif
                        @endforeach
                        <br><a href = "{{ route('accept', [$friend->userID]) }}">Accept</a>
                        </div>
                    @endif

                @endif
            @endforeach
            </div>
        </div>




        <table class="leader-table table-striped table table-responsive tableSmall">
            <tr class="leader-headings info">
                <td align="center" class="ranking-col">ID</td>
                <td align="center">Name</td>
                <td align="center">Links</td>
            </tr>
        @foreach($friends as $friend)
            @if($friend->requestAccepted == 1)
                @if($friend->userID != $userID)
                        <tr>
                            <td align="center"> {{ $friend->userID }} </td>
                            <td align="center">
                            @foreach($users as $user)
                                @if($user->id == $friend->userID)
                                        {{ $user->name }}
                                @endif
                            @endforeach
                            </td>
                            <td align="center"><strong><a href = "{{ route('openConversation', [$friend->userID]) }}"> Open conversation </a> </strong></td>
                        </tr>
                @endif
                 @if($friend->friendID != $userID)
                        <tr>
                            <td align="center"> {{ $friend->friendID }} </td>
                            <td align="center">
                                @foreach($users as $user)
                                    @if($user->id == $friend->friendID)
                                        {{ $user->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td align="center"><strong><a href = "{{ route('openConversation', [$friend->friendID]) }}"> Open conversation </a> </strong></td>
                        </tr>
                  @endif
            @endif
        @endforeach

@endsection
