<?php

namespace App\Http\Controllers;

use App\stocks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Excel;

class marketController extends Controller
{

//This where I write all my test functions for the app
//
//This one currently runs my ASX stock grabber
//    public function view ()
//    {
//        date_default_timezone_set('Australia/Melbourne');
//        $date = date('H-i-s_d-m-Y', time());
//        $tries = 0;
//        set_time_limit(0);
//        $stocks = DB::table('asxes')->pluck('symbol');
//        $list = [];
//        foreach($stocks as $stock)
//        {
// //           $dataURL = 'http://finance.yahoo.com/d/quotes.csv?s=' . $stock.".AX" ."&f=nac1p1%27";
//              $dataURL = 'http://finance.yahoo.com/d/quotes.csv?s=' . $stock.'.AX'.'&f=nl1p2';
//            $tries++;
//
//            //Get rid of tries on the server
//            if($tries == 100)
//            {
//                break;
//            }
//
////              if($tries == 0)
////                {
////                    $dataURL.=$stock.".AX";
////                    $tries++;
////                }
////                else
////                {
////                    $dataURL.="+".$stock.".AX";
////                    $tries++;
////                }
////            $data = file_get_contents($dataURL);
////            $stockinfo = $stock . $data;
//            $list[] = '"'.$stock . '",' . file_get_contents($dataURL);
//
//
//        }
////        echo $list;
//
//        $filename = $date . '-asx-list';
//        Excel::create($filename,function($excel) use($list){
//
//            $excel->sheet('ASX-List',function($sheet) use($list){
//
//               $sheet->fromArray($list);
//
//
//            });
//
//
//
//               })->store('csv');
//
//        Schema::dropIfExists('stocks');
//
//        Schema::create('stocks', function($table)
//        {
//            $table->string('symbol',20);
//            $table->string('name');
//            $table->float('price');
//            $table->string('perChange');
//            $table->timestamps('updated_at');
//        });
//
//        foreach($list as $stock)
//        {
//            $newStock = str_replace('"','',$stock);
//            $value = explode(',',$newStock);
//            stocks::create(
//                [
//                    'symbol' => $value[0],
//                    'name' => $value[1],
//                    'price' => $value[2],
//                    'perChange' => $value[3],
//                    'updated_at' => '5'
//                ]
//            );
//
//        }
//
////        return view('test',['stocks'=> $stocks]);
//        echo "Done";
//    }

//This one does the same as the above but has a slightly different output, for testing purposes
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
            $dataURL = 'http://download.finance.yahoo.com/d/quotes.csv?s=';
            for($x = 0; $x < $elements; $x++)
            {
                if($x == 0)
                {
                    $dataURL.= $tests[$x].'.AX';
                }
                else
                {
                    $dataURL.= "+".$tests[$x].".AX";
                }

            }
            $dataURL.= '&f=snac1p1%27 ';
            $list[] .= file_get_contents($dataURL);

           $count++;

        }

        $filename = $date . '-asx-list';
        Excel::create($filename,function($excel) use($list){

            $excel->sheet('ASX-List',function($sheet) use($list){

                $sheet->fromArray($list);


            });



        })->store('csv');

//        $file = File::files(app_path() . '/exports');
        $stockList = [];
        $handle = fopen(__DIR__ . '\..\..\exports\\'.$filename.'.csv', 'r');

        while(! feof($handle))
        {
            $stock = fgetcsv($handle);

            $stock[4] = basename($filename, '.csv');

            if(count($stock) == 5)
            {
                $stockList[] = $stock;
            }
        }

        fclose($handle);
        echo count($stockList) . ' to create<br/>';
        Schema::dropIfExists('stocks');

        Schema::create('stocks', function($table)
        {
            $table->string('symbol',20);
            $table->string('name');
            $table->float('price');
            $table->string('perChange');
            $table->timestamps('updated_at');
        });

        foreach($stockList as $stock)
        {
//            $newStock = str_replace('"','',$stock);
//            $value = explode(',',$newStock);
//            $corrupt = 'N/A';
//            $string = $value[1] .+ " " .+$corrupt .+ " ";

                stocks::create(
                    [
                        'symbol' => $stock[0],
                        'name' => $stock[1],
                        'price' => 0,
                        'perChange' => 0,
                        'updated_at' => '5'
                    ]
                );


        }

    }

    public function view3()
    {

        set_time_limit(600);
        date_default_timezone_set('Australia/Melbourne');
        $date = date('Y-m-d-H-i-s', time());
        $date2 = date('Y-m-d H-i:s', time());
        $stocks = DB::table('asxes')->pluck('symbol');
        $stocks = $stocks->toArray();
        $test = array_chunk($stocks,400);
        $list = [];

        $count = 0;
//        print_r($test);

        foreach($test as $tests)
        {
            $elements = count($tests);
            $dataURL = 'http://download.finance.yahoo.com/d/quotes.csv?s=';
            for($x = 0; $x < $elements; $x++)
            {
                if($x == 0)
                {
                    $dataURL.= $tests[$x].'.AX';
                }
                else
                {
                    $dataURL.= "+".$tests[$x].".AX";
                }

            }
            $dataURL.= '&f=snac1p1%27 ';
            $list[] .= file_get_contents($dataURL);

            $count++;

        }

        $filename = $date . '-asx-list';
        Excel::create($filename,function($excel) use($list){

            $excel->sheet('ASX-List',function($sheet) use($list){

                $sheet->fromArray($list);


            });



        })->store('csv');

//        $file = File::files(app_path() . '/exports');
        $stockList = [];
        $handle = fopen(__DIR__ . '/../../exports/'.$filename.'.csv', 'r');

        while(! feof($handle))
        {
            $stock = fgetcsv($handle);

            $stock[4] = basename($filename, '.csv');

            if(count($stock) == 5)
            {
                $stockList[] = $stock;
            }
        }

        fclose($handle);

        foreach($stockList as $stock)
        {
            if(strcmp($stock[2],"N/A") !== 0)
            {
                DB::table('stocks')
                    ->where('symbol',$stock[0])
                    ->update(['name' => $stock[1],'price' => $stock[2],'perChange'=> $stock[3],'updated_at'=> $date2]);

            }
        }















//        date_default_timezone_set('Australia/Melbourne');
//        $date = date('H-i-s_d-m-Y', time());
//        set_time_limit(0);
//        $stocks = DB::table('asxes')->pluck('symbol');
//        $stocks = $stocks->toArray();
//        $test = array_chunk($stocks,400);
//        $list = [];
//
//        $count = 0;
////        print_r($test);
//
//        foreach($test as $tests)
//        {
//
//
//
//
//
//
//        }
//            $elements = count($tests);
//            $dataURL = 'http://download.finance.yahoo.com/d/quotes.csv?s=';
//            for($x = 0; $x < $elements; $x++)
//            {
//                if($x == 0)
//                {
//                    $dataURL.= $tests[$x].'.AX';
//                }
//                else
//                {
//                    $dataURL.= "+".$tests[$x].".AX";
//                }
//
//            }
//            $dataURL.= '&f=snac1p1%27 ';
//            $list[] .= file_get_contents($dataURL);
//
//            $count++;
//
//        }
//
//        $filename = $date . '-asx-list';
//        Excel::create($filename,function($excel) use($list){
//
//            $excel->sheet('ASX-List',function($sheet) use($list){
//
//                $sheet->fromArray($list);
//
//
//            });
//
//
//
//        })->store('csv');
//
////        $file = File::files(app_path() . '/exports');
//        $stockList = [];
//        $handle = fopen(__DIR__ . '/../../exports/'.$filename.'.csv', 'r');
//
//        while(! feof($handle))
//        {
//            $stock = fgetcsv($handle);
//
//            $stock[4] = basename($filename, '.csv');
//
//            if(count($stock) == 5)
//            {
//                $stockList[] = $stock;
//            }
//        }
//
//        fclose($handle);
//
//        foreach($stockList as $stock)
//        {
//            if(strcmp($stock[2],"N/A") !== 0)
//            {
//                DB::table('stocks')
//                    ->where('symbol',$stock[0])
//                    ->update(['name' => $stock[1],'price' => $stock[2],'perChange'=> $stock[3]]);
//
//            }
//        }

    }

    public function view(){
//        Schema::dropIfExists('portfolio');
//        Schema::dropIfExists('owned_stocks');
//        Schema::dropIfExists('transactions');
//        Schema::create('portfolio', function ($table) {
//            /* Don't think we need to show ID for the portfolio but might need it for referencing purposes
//            Comment back in if we need it
//            $table->increments('id')->unique(); */
//            $table->integer('user_id')->unsigned();
//            $table->foreign('user_id')->references('id')->on('users');
//            $table->string('ownedStocks');
//            /* If we need to put it in/include this feature
//            $table->string('favouritedStocks'); */
//            $table->decimal('money',10,2);
//            $table->decimal('netWorth',10,2);
//
//            $table->rememberToken();
//            $table->timestamps();
//        });
//
//        Schema::create('owned_stocks', function ($table) {
//            /* Don't think we need to show ID for the portfolio but might need it for referencing purposes
//            Comment back in if we need it
//            $table->increments('id')->unique(); */
//            $table->string('user_id');
//            $table->string('stock_symbol');
//            $table->integer('number');
//            $table->timestamps();
//        });
//
//        Schema::create('transactions', function ($table)
//        {
//            $table->string('user_id');
//            $table->string('stock_symbol');
//            $table->integer('number');
//            $table->float('price');
//            $table->boolean('type'); //0 if its buy, 1 if its sell
//            $table->timestamps();
//        });
//
//        Schema::table('users', function($table) {
//            $table->dropColumn('admin');
//        });
//
//        Schema::create('watchlist', function ($table) {
//            $table->string('user_id');
//            $table->string('stock_symbol');
//            $table->float('curr_stock_price');
//            $table->float('wanted_price');
//            $table->float('percentage_change'/*,5,2 if we want to limit to 5 digits 2 of which is behind decimal*/);
//            $table->date('date_added');
//            $table->date('date_expire');
//            $table->boolean('is_positive');
//        });

//        Schema::table('watchlist', function($table) {
//            $table->float('expected_price');
//        });
       echo "added";
    }
}



