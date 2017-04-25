<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;

class marketController extends Controller
{
    public function view ()
    {
        date_default_timezone_set('Australia/Melbourne');
        $date = date('m-d-Y_H-i-s', time());
        $tries = 0;
//        set_time_limit(20);
        $stocks = DB::table('asxes')->pluck('symbol');
        $list = [];
        foreach($stocks as $stock)
        {
 //           $dataURL = 'http://finance.yahoo.com/d/quotes.csv?s=' . $stock.".AX" ."&f=nac1p1%27";
              $dataURL = 'http://finance.yahoo.com/d/quotes.csv?s=' . $stock.'.AX'.'&f=nd1l1v';
            $tries++;

            //Get rid of tries on the server
            if($tries == 10)
            {
                break;
            }

//              if($tries == 0)
//                {
//                    $dataURL.=$stock.".AX";
//                    $tries++;
//                }
//                else
//                {
//                    $dataURL.="+".$stock.".AX";
//                    $tries++;
//                }
            $list[] = file_get_contents($dataURL);


        }
//        echo $list;

        $filename = $date . '-asx-list';
        Excel::create($filename,function($excel) use($list){

            $excel->sheet('ASX-List',function($sheet) use($list){

               $sheet->fromArray($list);


            });



               })->store('csv');



//        return view('test',['stocks'=> $stocks]);
        echo "Done";
    }
}
