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

        if (!$portfolio)                          //Checks if the user doesn't have a portfolio in the database, then inserts one if thats true
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

    //Opens the buy page and passes the symbol selected on the market page
    function passSymbolBuy($symbol)
    {
        return view('pages.buy')->with('symbol', $symbol);
    }

    //Opens the sell page and passes the symbol selected from the users portfolio
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

        $quantity = $request->input('quantity');    //Sets the information from the buy form
        $symbol = $request->input('symbol');
        $price = $request->input('price');

        $checkID = DB::table('owned_stocks')->where('user_id', $userID)->value('user_id');      //Sets up checks for seeing if the user already owns this type of stock
        $checkSymbol = DB::table('owned_stocks')->where('user_id', $userID)->where('stock_symbol',$symbol)->value('stock_symbol');
        $checkAmount = DB::table('owned_stocks')->where('user_id', $userID)->where('stock_symbol', $symbol)->value('number');
        $checkNull = DB::table('owned_stocks')->where('user_id', $userID)->where('stock_symbol', $symbol)->value('created_at');

        $ownedStocks = $portfolio->ownedStocks;        //Sets data from the users portfolio
        $balance = $portfolio->money;
        $netWorth = $portfolio->netWorth;

        $newOwnedStocks = $checkAmount + $quantity;
        $flatCharge = 50;                                     //Sets the flat charge fee of the transaction
        $percentCharge = (1 / 100) * $price;                  //Calculates the percentage fee of the transaction of 1%
        $totalCost = $flatCharge + $percentCharge + $price;   //Calculates the cost of the transaction after fees
        $newBalance = $balance - $totalCost;                  //Calculates the users new balance after the transaction
        $newStocksOwned = $ownedStocks + $quantity;           //Calculates the new amount of this stock the user will own
        $newNetWorth = $netWorth - $totalCost;                //Calculates the new "profit"

        //Checks if the user has enough money for the transaction, then checks if they already own some stocks of the one they are trying to buy
        if($balance > $totalCost) {
            if($checkSymbol == $symbol) {
                if($checkID == $userID) {
                    DB::table('owned_stocks')                            //Database is updated if they do already own some of the stock
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
                DB::table('owned_stocks')->insert                      //New database item is created if this is the first of this stock they own
                (
                    [
                        'user_id' => $userID,
                        'stock_symbol' => $symbol,
                        'number' => $quantity
                    ]
                );
            }
            DB::table('portfolio')                                    //Users portfolio is updated with new information
                ->where('user_id', $userID)
                ->update(
                    [
                        'money' => $newBalance,
                        'ownedStocks' => $newStocksOwned,
                        'netWorth' => $newNetWorth
                    ]
                );

            DB::table('transactions')->insert                       //new transaction is added to the transactions database with the information
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


            echo '<script language="javascript">';                   //This message is displayed if it goes through
            echo 'alert("Transaction complete! Your shares will now be visible from your portfolio")';
            echo '</script>';
        }
        else
        {
            echo '<script language="javascript">';                 //This message is displayed if they don't have enough money for the purchase
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

        $quantity = $request->input('quantity');    //Sets the data from the users sell page form
        $symbol = $request->input('symbol');
        $price = $request->input('price');

        $ownedStocks = $portfolio->ownedStocks;       //Sets data from the users portfolio
        $balance = $portfolio->money;
        $netWorth = $portfolio->netWorth;

        $stockToSell = DB::table('owned_stocks')->where('user_id', $userID)->where('stock_symbol', $symbol)->first();  //Finds the stock the user wants to sell from the database
        $numberOwned = $stockToSell->number;                                                                           //Calculates how many of the stock the suer will have after the transaction

        $flatCharge = 50;                             //Sets the flat charge fee
        $percentCharge = (.25 / 100) * $price;        //Calculates the percentage fee of the transaction of .25%
        $fees = $flatCharge + $percentCharge;         //Calculates the combined fees
        $totalMoney = $price - $fees;                 //Calculates the cost after fees

        $newBalance = $balance + $totalMoney;         //Calculates the users new balance after the transaction
        $newStocksOwned = $ownedStocks - $quantity;   //Calculates the new amount of this stock the user will own
        $newQuantity = $numberOwned - $quantity;      //Calculates the new amount of this stock the user will own
        $newNetWorth = $netWorth + $totalMoney;       //Calculates the new "profit"

        if($newQuantity == 0)     //Checks if the user will be left with 0 of this stock after the transaction
        {
            DB::table('owned_stocks')->where('user_id', $userID)->where('stock_symbol', $symbol)->delete();    //Deletes it from the database if they will

            DB::table('transactions')->insert          //makes a transaction record
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

            DB::table('portfolio')                     //Updates the users portfolio
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
        //Checks if the user is left with more than 0 of the stock after the transaction
        elseif($newQuantity > 0) {
            DB::table('owned_stocks')
                ->where('user_id', $userID)
                ->where('stock_symbol', $symbol)
                ->update(
                    [
                        'number' => $newQuantity
                    ]
                );


            DB::table('portfolio')                          //updates the users portfolio
                ->where('user_id', $userID)
                ->update(
                    [
                        'money' => $newBalance,
                        'ownedStocks' => $newStocksOwned,
                        'netWorth' => $newNetWorth
                    ]
                );

            DB::table('transactions')->insert             //adds a new transaction
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

            echo '<script language="javascript">';          //This message is displayed if the sale goes through
            echo 'alert("Transaction complete! Your shares have been sold and the money has been added to your account")';
            echo '</script>';


        }
        else          //If the user tries to sell more stock than they have, this error is displayed
        {
            echo '<script language="javascript">';
            echo 'alert("You do not have enough shares to sell that quantity. No changes have been made.")';
            echo '</script>';
        }


        return redirect('account');
    }

    function banUser ($userID)
    {
        $userId = $userID;

        DB::table('transactions')->where('user_id',$userId)->delete();
        DB::table('owned_stocks')->where('user_id', $userId)->delete();
        DB::table('portfolio')->where('user_id', $userId)->delete();
        DB::table('users')->where('id', $userId)->delete();
        echo '<script language="javascript">';
        echo 'alert("Working")';
        echo '</script>';
        return redirect('admin');

    }

    function searchSymbol(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        if(isset($searchTerm))
        {
            return view('pages.market')->with('searchTerm', $searchTerm);
        }
        else
        {
            return view('pages.market');
        }


    }
}
