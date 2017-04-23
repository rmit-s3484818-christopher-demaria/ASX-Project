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
}
