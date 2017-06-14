@extends('layouts.master')
@section('title')
    Messages
@stop
@section('body')

    <?php
    $userID = Auth::id(); //gets the users ID
    $friends = DB::table('friends')->where('userID', $userID)->orwhere('friendID', $userID)->get(); //Gets all the instances where the user is listed on either side of the friends relationship (Either sent or received the friend request)
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

            <!-- Form for sending friend requests. Enter the friends ID that you want to add. -->
            <form role ="form" method="POST" action="{{ route('friendRequest') }}">
                <input name="friendID" class = "form-control" type="number" id = "friendID" min = "1" placeholder = "Enter your friends User ID here">
                <button class="btn btn-success confirmBtn friendButton"><span class="glyphicon glyphicon-ok-circle" type = "Submit"></span><h3 class="buySellBtns">Send</h3></button>
            </form>
        </div>


        <div class = "activeRequestsBox">
            <p class="friendsHeader">Active friend requests</p>
            <div class = "activeRequests">

                <!-- Loops through all the active friend requests the user has -->
            @foreach($friends as $friend)
                @if($friend->requestAccepted == 0)                      <!-- Checks to see if the request hasn't been responded to -->
                    @if($friend->userID != $userID)                     <!-- Checks to only display friend request received, not requests sent by the user -->
                        <div class = "singleRequest">
                            <b>User ID:</b> {{ $friend->userID }}<br>   <!-- Displays the senders User ID -->
                            <b>User Name: </b>
                        @foreach($users as $user)                       <!-- Loops through the user table to find the friends name, since the name isnt stored in the "friends" table like the user ID -->
                            @if($user->id == $friend->userID)
                                {{ $user->name }}
                            @endif
                        @endforeach
                        <br><a href = "{{ route('accept', [$friend->userID]) }}">Accept</a>          <!-- Displays link to accept each friend request -->
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
                <td align="center">Inbox</td>
            </tr>

            <!-- Loops through all the friends the user currently has -->
        @foreach($friends as $friend)
            @if($friend->requestAccepted == 1)                                                     <!--Checks if the friend request has been accepted -->
                @if($friend->userID != $userID)                                                    <!-- Checks through the friend request senders, only displays if they are not from the user-->
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
                 @if($friend->friendID != $userID)                                               <!-- Checks through the friend request receivers, only displays if they are not from the user-->
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
