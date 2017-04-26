<?php

namespace App\Console\Commands;

use App\stocks;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;

class getASX extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getASX';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves the list of the current ASX list';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle()
    {
        date_default_timezone_set('Australia/Melbourne');
        $date = date('H-i-s_d-m-Y', time());
        $tries = 0;
//        set_time_limit(20);
        $stocks = DB::table('asxes')->pluck('symbol');
        $list = [];
        foreach($stocks as $stock)
        {
            //           $dataURL = 'http://finance.yahoo.com/d/quotes.csv?s=' . $stock.".AX" ."&f=nac1p1%27";
            $dataURL = 'http://finance.yahoo.com/d/quotes.csv?s=' . $stock.'.AX'.'&f=nl1p2';
            $tries++;

            //Get rid of tries on the server

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

    }

}
