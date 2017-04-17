<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class marketController extends Controller
{
    public function view ()
    {
        $stocks = DB::table('asxes')->get();

        return view('test',['stocks'=> $stocks]);
    }
}
