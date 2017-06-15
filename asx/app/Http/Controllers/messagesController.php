<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class messagesController extends Controller
{

        function friendRequest(Request $request)
    {
        $userID = Auth::id();
        $friendID = $request->input('friendID');
        $test1 = DB::table('friends')->where('userID', $userID)->where('friendID', $friendID)->first();
        $test2 = DB::table('friends')->where('userID', $friendID)->where('friendID', $userID)->first();
        $friendExists = DB::table('users')->where('id', $friendID)->first();


        if (isset($test1)) //check if the user has already send a friend request to this friend
        {
            echo '<script language="javascript">';
            echo 'alert("You are already friends or a friend request is pending")';
            echo '</script>';
        }
        elseif (isset($test2)) //check if the user has already received a friend request to this friend
        {
            echo '<script language="javascript">';
            echo 'alert("You are already friends or a friend request is pending")';
            echo '</script>';
        }
        elseif (!isset($friendExists)) //checks if the user exists in the database
        {
            echo '<script language="javascript">';
            echo 'alert("User does not exist")';
            echo '</script>';
        }
        //adds the friends in the database, sets "requestAccepted" to '0' meaning it has not been accepted yet
        else {

            DB::table('friends')->insert
            (
                [
                    'userID' => $userID,
                    'friendID' => $friendID,
                    'requestAccepted' => 0
                ]
            );
        }
        return redirect('friends');
    }

    //if the friend request is accepted, the "requestAccepted" is changed to '1' to show they are now friends
    function accept ($friendID)
    {
        $userID = Auth::id();

        DB::table('friends')
            ->where('userID', $friendID)
            ->where('friendID', $userID)
            ->update(
                [
                    'requestAccepted' => 1
                ]
            );

        return redirect('friends');
    }

    //if the friend request is declined, then the friendship is deleted
   function decline ($ID)
    {
        $userID = Auth::id();

        DB::table('friends')->where('userID', $ID)->where('friendID', $userID)->delete();

        return redirect('friends');
    }

    function deleteFriend ($friendID)
    {
        $userID = Auth::id();

        DB::table('friends')->where('userID', $friendID)->where('friendID', $userID)->delete();
        
        return redirect('friends');
    }

    function deleteFriend2 ($friendID)
    {
        $userID = Auth::id();

        DB::table('friends')->where('userID', $userID)->where('friendID', $friendID)->delete();

        return redirect('friends');
    }

    //opens up the messages page and passes through the selected users ID
    function openConversation($friendID)
    {
        return view('pages.messages')->with('friendID', $friendID);
    }

    //adds the message to the database
    function sendMessage(Request $request)
    {
        date_default_timezone_set('Australia/Melbourne');
        $date = date('Y-m-d H-i;s', time());

        $userID = Auth::id();
        $message = $request->input('message');
        $friendID = $request->input('friendID');

        DB::table('messages')->insert
        (
            [
                'sender_id' => $userID,
                'receiver_id' => $friendID,
                'message' => $message,
                'money' => 0,
                'read' => 0,
                'created_at' => $date
            ]
        );


        return view('pages.messages')->with('friendID', $friendID); //displays the updated messages page

    }

}
