<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;

class pageController extends Controller
{
    function checkLog(){

        if($user = Auth::user())
        {
           return view('pages.home');
        }
        else
        {
            return redirect('register');
        }
    }

    function checkTrading()
    {
        $userID = Auth::id();
        $money = 1000000;
        $portfolio = DB::table('portfolio')->where('user_id', $userID)->first();

        if (!$portfolio)
        {
            DB::table('portfolio')->insert
            (
                [
                    'user_id' => $userID,
                    'ownedStocks' => 0,
                    'money' => $money,
                    'netWorth' => $money
                ]
            );
        }
        else
        {
            return view('pages.account');
        }

    }

    function passSymbol($symbol)
    {
    }

}
