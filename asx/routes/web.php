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
Route::get('leader', function(){
    return view('pages.leaderboard');
});

Route::get('settings', function(){
    return view('pages.settings');
});

Route::get('market', function(){
    return view('pages.market');
});

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