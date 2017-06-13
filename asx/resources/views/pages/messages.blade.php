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

    $messages = DB::table('messages')->where('receiver_id', $userID)->get();
    $messageTests = DB::table('messages')->wherein('sender_id', [$userID, $friendID])->wherein('receiver_id', [$userID, $friendID])->orderby('created_at', 'desc')->get();
    $users = DB::table('users')->get();
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
               @foreach($users as $user)
                   @if($user->id == $friendID)
                       {{ $user->name }}
                   @endif
               @endforeach
           </p>

        <form role ="form" method="POST" action="{{ route('sendMessage') }}">
            <textarea name="message" class = "form-control" rows="5" cols="30" placeholder="Type your message here"></textarea>
            <input type="number" class = "form-control" name="money" value="0" min ="1"><br>
            <input name="friendID" class = "form-control" type = "hidden" id = "friendID" value = '{{$friendID}}'>
            <button class="btn btn-success confirmBtn"><span class="glyphicon glyphicon-ok-circle" type = "Submit"></span><h3 class="buySellBtns">Send</h3></button>
        </form>
       </div>

        <p class = "inboxHeading">Conversation History</p>
        <div class ="messagesBox">
    @foreach($messageTests as $messageTest)
        <div class = "singleMessage">
            @if($messageTest->sender_id == $userID)
                <div class ="messageName"> You: </div>
                <p class ="messageText"> {{$messageTest->message}} </p>
            @else
                <p class ="messageName">
                    @foreach($users as $user)
                        @if($user->id == $friendID)
                            {{ $user->name }}:
                        @endif
                    @endforeach
                </p>
                <p class ="messageText"> {{$messageTest->message}} </p>
            @endif

        </div>
    @endforeach
        </div>


@endsection
