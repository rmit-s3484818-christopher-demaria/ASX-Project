<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class marketController extends Controller
{
    public function view ()
    {
        set_time_limit(5400);
        $tries = 0;

        $stocks = DB::table('asxes')->pluck('symbol');

        $filename = 'asx-list';
 //       Excel::create($filename,function($stocks){
            foreach($stocks as $stock)
            {
               $dataURL = 'http://finance.yahoo.com/d/quotes.csv?s='.$stock.'.AX&f=nac1p1';
               $data = file_get_contents($dataURL);
               echo $data;

               if(++$tries > 10) break;
            }

 //       })->export('csv');



//        return view('test',['stocks'=> $stocks]);
    }
}
