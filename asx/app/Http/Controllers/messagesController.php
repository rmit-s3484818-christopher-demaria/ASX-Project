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


        if (isset($test1))
        {
            echo '<script language="javascript">';
            echo 'alert("You are already friends or a friend request is pending")';
            echo '</script>';
        }
        elseif (isset($test2))
        {
            echo '<script language="javascript">';
            echo 'alert("You are already friends or a friend request is pending")';
            echo '</script>';
        }
        elseif (!isset($friendExists))
        {
            echo '<script language="javascript">';
            echo 'alert("User does not exist")';
            echo '</script>';
        }
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

//    function decline ($friendID)
//    {
//        return view('pages.buy');
//    }

    function openConversation($friendID)
    {
        return view('pages.messages')->with('friendID', $friendID);
    }

    function sendMessage(Request $request)
    {
        date_default_timezone_set('Australia/Melbourne');
        $date = date('Y-m-d H-i;s', time());

        $userID = Auth::id();
        $message = $request->input('message');
        $friendID = $request->input('friendID');
        $money = $request->input('money');

        DB::table('messages')->insert
        (
            [
                'sender_id' => $userID,
                'receiver_id' => $friendID,
                'message' => $message,
                'money' => $money,
                'read' => 0,
                'created_at' => $date
            ]
        );

        return redirect('friends');

    }
}