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
        set_time_limit(600);
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

        foreach($stockList as $stock)
        {
            if(strcmp($stock[2],"N/A") !== 0)
            {
                DB::table('stocks')
                    ->where('symbol',$stock[0])
                    ->update(['name' => $stock[1],'price' => $stock[2],'perChange'=> $stock[3]]);

            }
        }


      }

}
