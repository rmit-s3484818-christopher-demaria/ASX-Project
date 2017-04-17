<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class marketController extends Controller
{
    public function view ()
    {
        $stocks = DB::table('asxes')->pluck('symbol');

        $filename = 'asx-list';
 //       Excel::create($filename,function($stocks){
            foreach($stocks as $stock)
            {
//                $tries++;
                echo $stock;

//                $dataURL = 'http://finance.yahoo.com/d/quotes.csv?s='.$symbol.'.AX&f=nac1p1';
//                $data = file_get_contents($dataURL);
//                echo $data;
            }

 //       })->export('csv');



//        return view('test',['stocks'=> $stocks]);
    }
}
