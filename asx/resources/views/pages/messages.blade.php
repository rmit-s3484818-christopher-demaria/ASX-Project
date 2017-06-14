@extends('layouts.master')
@section('title')
    Messages
@stop
@section('body')

    <?php
    $userID = Auth::id(); //sets the user ID
    $messages = DB::table('messages')->wherein('sender_id', [$userID, $friendID])->wherein('receiver_id', [$userID, $friendID])->orderby('created_at', 'desc')->get(); //gets all the messages between the user and the friend who was selected from the previous page (friends.blade.php)
    $friend = DB::table('users')->where('id', $friendID)->first(); //gets the friends info from the user database
    ?>

    <div class="navbarMargin">
        <div class="container-fluid">
            <div class="container-fluid">
                <div>
                    <h2 class="pageHeading">Inbox</h2>
                    <hr>
                </div>
            </div>
        </div>


       <div class ="sendMessageBox">
           <p class ="inboxHeading"> Chatting with
               {{$friend->name}}
           </p>

           <!-- Form for sending messages. Passes through the message, amount of money and the hidden friendsID -->
        <form role ="form" method="POST" action="{{ route('sendMessage') }}">
            <textarea name="message" class = "form-control" rows="5" cols="30" placeholder="Type your message here" maxlength="150"></textarea>
            <input name="friendID" class = "form-control" type = "hidden" id = "friendID" value = '{{$friendID}}'>
            <button class="btn btn-success confirmBtn"><span class="glyphicon glyphicon-ok-circle" type = "Submit"></span><h3 class="buySellBtns">Send</h3></button>
        </form>
       </div>

        <p class = "inboxHeading">Conversation History</p>
         <div class ="messagesBox">

             <!-- Loops through the messages between the user and friend. Puts "You" before the sent messages and the friends name before the received ones. -->
          @foreach($messages as $message)
             <div class = "singleMessage">
                @if($message->sender_id == $userID)
                    <div class ="messageName"> You: </div>
                    <div class ="messageText"> {{$message->message}} </div>
                @else
                    <div class ="messageName">
                        {{$friend->name}}:
                    </div>
                    <div class ="messageText"> {{$message->message}} </div>
                @endif
             </div>
          @endforeach
        </div>


@endsection
