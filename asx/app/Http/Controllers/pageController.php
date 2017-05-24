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

    function passSymbolBuy($symbol)
    {
        return view('pages.buy')->with('symbol', $symbol);
    }

    function passSymbolSell($symbol)
    {
        return view('pages.sell')->with('symbol', $symbol);
    }
    function passUserProfile($user)
    {
        return view('pages.userpage')->with('user', $user);
    }
    function buyStock(Request $request)
    {
        date_default_timezone_set('Australia/Melbourne');
        $date = date('Y-m-d H-i;s', time());
        $userID = Auth::id();
        $portfolio = DB::table('portfolio')->where('user_id', $userID)->first();
        //$ownedStock = DB::table('owned_stocks')->where('user_id', $userID)->get();
        $quantity = $request->input('quantity');
        $symbol = $request->input('symbol');
        $price = $request->input('price');
        $checkID = DB::table('owned_stocks')->where('user_id', $userID)->value('user_id');
        $checkSymbol = DB::table('owned_stocks')->where('user_id', $userID)->where('stock_symbol',$symbol)->value('stock_symbol');
        $checkAmount = DB::table('owned_stocks')->where('user_id', $userID)->where('stock_symbol', $symbol)->value('number');
        $checkNull = DB::table('owned_stocks')->where('user_id', $userID)->where('stock_symbol', $symbol)->value('created_at');
        $ownedStocks = $portfolio->ownedStocks;
        $balance = $portfolio->money;
        $netWorth = $portfolio->netWorth;
        $newOwnedStocks = $checkAmount + $quantity;
        $flatCharge = 50;
        $percentCharge = (1 / 100) * $price;
        $totalCost = $flatCharge + $percentCharge + $price;
        $newBalance = $balance - $totalCost;
        $newStocksOwned = $ownedStocks + $quantity;
        $newNetWorth = $netWorth - $totalCost;

        if($balance > $totalCost) {
            if($checkSymbol == $symbol) {
                if($checkID == $userID) {
                    DB::table('owned_stocks')
                        ->where('user_id', $userID)
                        ->where('stock_symbol', $symbol)
                        ->update(
                            [
                                'number' => $newOwnedStocks
                            ]
                        );
                }
            }
            else {
                DB::table('owned_stocks')->insert
                (
                    [
                        'user_id' => $userID,
                        'stock_symbol' => $symbol,
                        'number' => $quantity
                    ]
                );
            }
            DB::table('portfolio')
                ->where('user_id', $userID)
                ->update(
                    [
                        'money' => $newBalance,
                        'ownedStocks' => $newStocksOwned,
                        'netWorth' => $newNetWorth
                    ]
                );

            DB::table('transactions')->insert
            (
                [
                    'user_id' => $userID,
                    'stock_symbol' => $symbol,
                    'number' => $quantity,
                    'price' => $totalCost,
                    'type' => 0,
                    'created_at' => $date
                ]
            );


            echo '<script language="javascript">';
            echo 'alert("Transaction complete! Your shares will now be visible from your portfolio")';
            echo '</script>';
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Your balance is too low to complete this purchase. No purchase has been made")';
            echo '</script>';
        }
        return redirect('account');

    }


    function sellStock(Request $request)
    {
        date_default_timezone_set('Australia/Melbourne');
        $date = date('Y-m-d H-i;s', time());
        $userID = Auth::id();
        $portfolio = DB::table('portfolio')->where('user_id', $userID)->first();

        $quantity = $request->input('quantity');
        $symbol = $request->input('symbol');
        $price = $request->input('price');
        $ownedStocks = $portfolio->ownedStocks;
        $balance = $portfolio->money;
        $netWorth = $portfolio->netWorth;

        $stockToSell = DB::table('owned_stocks')->where('user_id', $userID)->where('stock_symbol', $symbol)->first();
        $numberOwned = $stockToSell->number;

        $flatCharge = 50;
        $percentCharge = (.25 / 100) * $price;
        $fees = $flatCharge + $percentCharge;
        $totalMoney = $price - $fees;

        $newBalance = $balance + $totalMoney;
        $newStocksOwned = $ownedStocks - $quantity;
        $newQuantity = $numberOwned - $quantity;
        $newNetWorth = $netWorth + $totalMoney;

        if($newQuantity == 0)
        {
            DB::table('owned_stocks')->where('user_id', $userID)->where('stock_symbol', $symbol)->delete();

            DB::table('transactions')->insert //makes a transaction record
            (
                [
                    'user_id' => $userID,
                    'stock_symbol' => $symbol,
                    'number' => $quantity,
                    'price' => $totalMoney,
                    'type' => 1,
                    'created_at' => $date
                ]


            );

            DB::table('portfolio')
                ->where('user_id', $userID)
                ->update(
                    [
                        'money' => $newBalance,
                        'ownedStocks' => $newStocksOwned,
                        'netWorth' => $newNetWorth
                    ]
                );

            echo '<script language="javascript">';
            echo 'alert("Transaction complete! Your shares have been sold and the money has been added to your account")';
            echo '</script>';

        }
        elseif($newQuantity > 0) {
            DB::table('owned_stocks')
                ->where('user_id', $userID)
                ->where('stock_symbol', $symbol)
                ->update(
                    [
                        'number' => $newQuantity
                    ]
                );


            DB::table('portfolio')
                ->where('user_id', $userID)
                ->update(
                    [
                        'money' => $newBalance,
                        'ownedStocks' => $newStocksOwned,
                        'netWorth' => $newNetWorth
                    ]
                );

            DB::table('transactions')->insert
            (
                [
                    'user_id' => $userID,
                    'stock_symbol' => $symbol,
                    'number' => $quantity,
                    'price' => $totalMoney,
                    'type' => 1,
                    'created_at' => $date
                ]
            );

            echo '<script language="javascript">';
            echo 'alert("Transaction complete! Your shares have been sold and the money has been added to your account")';
            echo '</script>';


        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("You do not have enough shares to sell that quantity. No changes have been made.")';
            echo '</script>';
        }


        // need to code for a dialogue box to open up to show the error in an else
        return redirect('account');
    }
}
