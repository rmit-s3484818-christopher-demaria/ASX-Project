<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use DB;

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
        return view('pages.buy')->with('symbol', $symbol);
    }

    function buyStock(Request $request)
    {
        $userID = Auth::id();
        $portfolio = DB::table('portfolio')->where('user_id', $userID)->first();

        $quantity = $request->input('quantity');
        $symbol = $request->input('symbol');
        $price = $request->input('price');
        $ownedStocks = $portfolio->ownedStocks;
        $balance = $portfolio->money;
        $netWorth = $portfolio->netWorth;

        $flatCharge = 50;
        $percentCharge = (1 / 100) * $price;
        $totalCost = $flatCharge + $percentCharge + $price;
        $newBalance = $balance - $totalCost;
        $newStocksOwned = $ownedStocks + $quantity;


        DB::table('owned_stocks')->insert
        (
            [
                'user_id' => $userID,
                'stock_symbol' => $symbol,
                'number' => $quantity
            ]
        );

        DB::table('portfolio')
                   ->where('user_id', $userID)
                   ->update(
                       [
                           'money' => $newBalance,
                           'owned_stocks' => $newStocksOwned
                       ]
                   );

        return view('pages.account');

    }
}
