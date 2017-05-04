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

    function buyStock(Request $request)
    {
        $userID = Auth::id();
        $portfolio = DB::table('portfolio')->where('user_id', $userID)->first();
        $ownedStock = DB::table('owned_stocks')->where('user_id', $userID)->first();
        $quantity = $request->input('quantity');
        $symbol = $request->input('symbol');
        $price = $request->input('price');
        $checkID = $ownedStock->user_id;
        $checkSymbol = $ownedStock->stock_symbol;
        $checkAmount = $ownedStock->number;
        $ownedStocks = $portfolio->ownedStocks;
        $balance = $portfolio->money;
        $netWorth = $portfolio->netWorth;

        $flatCharge = 50;
        $percentCharge = (1 / 100) * $price;
        $totalCost = $flatCharge + $percentCharge + $price;
        $newBalance = $balance - $totalCost;
        $newStocksOwned = $ownedStocks + $quantity;

        if($balance > $totalCost) {
            if ($checkSymbol == $symbol && $checkID == $userID) {
                $newOwnedStocks = $checkAmount + $quantity;
                DB::table('owned_stocks')
                    ->where('user_id', $checkID)
                    ->where('stock_symbol', $checkSymbol)
                    ->update(
                        [
                            'number' => $newOwnedStocks
                        ]
                    );
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
                        'ownedStocks' => $newStocksOwned
                    ]
                );
        }
        return view('pages.account');

    }

    function sellStock(Request $request)
    {
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
        $newNetWorth = $netWorth - $fees;

        if($newQuantity == 0)
        {
            DB::table('owned_stocks')->where('user_id', $userID)->where('stock_symbol', $symbol)->delete();
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
        }
        // need to code for a dialogue box to open up to show the error in an else
        return view('pages.account');
    }
}
