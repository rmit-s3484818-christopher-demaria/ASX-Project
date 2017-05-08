<?php

namespace App\Http\Controllers;

use App\stocks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Excel;

class marketController extends Controller
{
    public function view ()
    {
        date_default_timezone_set('Australia/Melbourne');
        $date = date('H-i-s_d-m-Y', time());
        $tries = 0;
        set_time_limit(0);
        $stocks = DB::table('asxes')->pluck('symbol');
        $list = [];
        foreach($stocks as $stock)
        {
 //           $dataURL = 'http://finance.yahoo.com/d/quotes.csv?s=' . $stock.".AX" ."&f=nac1p1%27";
              $dataURL = 'http://finance.yahoo.com/d/quotes.csv?s=' . $stock.'.AX'.'&f=nl1p2';
            $tries++;

            //Get rid of tries on the server
            if($tries == 100)
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
//            $data = file_get_contents($dataURL);
//            $stockinfo = $stock . $data;
            $list[] = '"'.$stock . '",' . file_get_contents($dataURL);


        }
//        echo $list;

        $filename = $date . '-asx-list';
        Excel::create($filename,function($excel) use($list){

            $excel->sheet('ASX-List',function($sheet) use($list){

               $sheet->fromArray($list);


            });



               })->store('csv');

        Schema::dropIfExists('stocks');

        Schema::create('stocks', function($table)
        {
            $table->string('symbol',20);
            $table->string('name');
            $table->float('price');
            $table->string('perChange');
            $table->timestamps('updated_at');
        });

        foreach($list as $stock)
        {
            $newStock = str_replace('"','',$stock);
            $value = explode(',',$newStock);
            stocks::create(
                [
                    'symbol' => $value[0],
                    'name' => $value[1],
                    'price' => $value[2],
                    'perChange' => $value[3],
                    'updated_at' => '5'
                ]
            );

        }

//        return view('test',['stocks'=> $stocks]);
        echo "Done";
    }

    public function view2()
    {
        date_default_timezone_set('Australia/Melbourne');
        $date = date('H-i-s_d-m-Y', time());
        set_time_limit(0);
        $stocks = DB::table('asxes')->pluck('symbol');
        $stocks = $stocks->toArray();
        $test = array_chunk($stocks,400);
        $list = [];

        $count = 0;
//        print_r($test);

        foreach($test as $tests)
        {
            $elements = count($tests);
            $dataURL = 'http://finance.yahoo.com/d/quotes.csv?s=';
            for($x = 0; $x < $elements; $x++)
            {
                if($x == 0)
                {
                    $dataURL.= $tests[$x].'.AX';
                }
                else
                {
                    $dataURL.= "+".$tests[$x].'.AX';
                }

            }
            $dataURL.= '&f=snac1p1%27 ';
            echo $dataURL;
            $list[] .= file_get_contents($dataURL);

           $count++;

        }

        echo "FINISHED";





//        $list = [];
//        foreach($stocks as $stock)
//        {
//           $dataURL = 'http://finance.yahoo.com/d/quotes.csv?s=' . $stock.".AX" ."&f=nac1p1%27";
//            $dataURL = 'http://finance.yahoo.com/d/quotes.csv?s=' . $stock.'.AX'.'&f=nl1p2';
//            $tries++;
//
//            //Get rid of tries on the server
//            if($tries == 100)
//            {
//                break;
//            }

//--------------------------------------------------------------------------
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
//            $data = file_get_contents($dataURL);
//            $stockinfo = $stock . $data;

//---------------------------------------------------------------


//            $list[] = file_get_contents($dataURL);
//
//
//        }


    }
}
