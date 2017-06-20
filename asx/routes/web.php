<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('pages.home');
//});

Route::get('/','pageController@checkLog');

Route::get('account', function(){
    return view('pages.account');
});


route::get('register',function(){
   return view('auth.register');
});

Route::get('stock', function(){
    return view('pages.stock');
});

Route::get('goTest', function(){
    return view('test');
});

Route::get('leader', function(){
    return view('pages.leaderboard');
});

Route::get('settings', function(){
    return view('pages.settings');
});

Route::get('market', function(){
    return view('pages.market');
});

Route::get('friends', function(){
    return view('pages.friends');
});

Route::get('messages', function(){
    return view('pages.messages');
});

Route::get('admin', function(){
    return view('pages.admin');
});
Route::get('watchlist', function(){
    return view('pages.watchlist');
});
//Route::get('buy', function(){
//   return view('pages.buy');
//});

Route::get('sell', function(){
    return view('pages.sell');
});

Route::get('company', function(){
    return view('pages.company');
});

Route::get('admin/{user}', [
    'as' => 'passUserProfile',
    'uses' => 'pageController@passUserProfile'
]);

Route::get('buy/{symbol}', [
    'as' => 'passSymbolBuy',
    'uses' => 'pageController@passSymbolBuy'
]);

Route::get('sell/{symbol}', [
    'as' => 'passSymbolSell',
    'uses' => 'pageController@passSymbolSell'
]);

Route::delete('admin/{id}', [
    'uses' => 'pageController@banUser'
]);
Route::delete('account/{id}', [
    'uses' => 'pageController@deleteUser'
]);
Route::post('buy', [
    'as' => 'buyStock',
    'uses' => 'pageController@buyStock'
]);
Route::post('makeWatchlist', [
    'as' => 'addToWatchList',
    'uses' => 'pageController@watchList'
]);

Route::post('sell', [
    'as' => 'sellStock',
    'uses' => 'pageController@sellStock'
]);

Route::post('friends', [
    'as' => 'friendRequest',
    'uses' => 'messagesController@friendRequest'
]);

Route::get('friends/{friendID}', [
    'as' => 'accept',
    'uses' => 'messagesController@accept'
]);

Route::get('home/{ID}', [
    'as' => 'decline',
'uses' => 'messagesController@decline'
]);

Route::get('inbox/{friendID}', [
    'as' => 'openConversation',
    'uses' => 'messagesController@openConversation'
]);

Route::get('friend/{friendID}', [
    'as' => 'deleteFriend',
    'uses' => 'messagesController@deleteFriend'
]);

Route::get('home/{friendID}', [
    'as' => 'deleteFriend2',
    'uses' => 'messagesController@deleteFriend2'
]);

Route::post('messages', [
    'as' => 'sendMessage',
    'uses' => 'messagesController@sendMessage'
]);

Route::post('market', [
    'as' => 'searchTerm',
    'uses' => 'pageController@searchSymbol'
]);

Route::post('admin', [
    'as' => 'searchUser',
    'uses' => 'pageController@searchUser'
]);

//    return view('test');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('auth/logout', 'Auth\LoginController@logout');

Route::get('store', 'StockController@store');

Route::get('asxList', 'createAsxList@findAsxList');

Route::get('ExportClients','ExcelController@ExportClients');
Route::post('ImportClients', 'ExcelController@ImportClients');
Route::get('upload','ExcelController@upload');
Route::get('test','marketController@view');

Route::get('test2','marketController@view2');
Route::get('test3','marketController@view3');