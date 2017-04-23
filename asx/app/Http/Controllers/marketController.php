<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;

class marketController extends Controller
{
    public function view ()
    {


        $filename = 'asx-list';
        Excel::create($filename,function($stocks){
            set_time_limit(5400);

            $tries = 0;
            $dataURL = 'http://finance.yahoo.com/d/quotes.csv?s=';

            $stocks = DB::table('asxes')->pluck('symbol');

            foreach($stocks as $stock)
            {
                if($tries == 0)
                {
                    $dataURL.=$stock.".AX";
                    $tries++;
                }
                else
                {
                    $dataURL.="+".$stock.".AX";
                    $tries++;
                }
            }

            $dataURL.="&f=na";
            echo $dataURL;

        $data = file_get_contents($dataURL);
         echo $data;



               })->export('csv');



//        return view('test',['stocks'=> $stocks]);
    }
}
