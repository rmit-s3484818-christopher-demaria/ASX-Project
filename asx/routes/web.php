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

Route::get('/', function () {
    return view('pages.home');
});
Route::get('account', function(){
    return view('pages.account');
});

Route::get('stock', function(){
    return view('pages.stock');
});

Route::get('leader', function(){
    return view('pages.leaderboard');
});

Route::get('market', function(){
    return view('pages.market');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('auth/logout', 'Auth\LoginController@logout');
