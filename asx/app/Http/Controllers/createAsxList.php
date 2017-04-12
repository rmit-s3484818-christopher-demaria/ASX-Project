<?php

namespace App\Http\Controllers;

use App\asxList;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;

class createAsxList extends BaseController
{
    public function findAsxList()
    {
        $list = [];

            $handle = fopen("/asxStock/asx.csv", "r");

            while(! feof($handle))
            {
                $stock = fgetcsv($handle);

                $stock[3] = basename($handle, '.csv');

                if(count($stock) == 4)
                {
                    $list[] = $stock;
                }
            }

        fclose($handle);

        /**  ppd($stocks); **/

        echo count($list) . ' to create<br/>';

        foreach($list as $stock)
        {
            $row = asxList::create(
                [
                    'name' => $stock[0],
                    'symbol' => $stock[1],
                    'updated_at' => '5'
                ]
            );

            echo 'created stock: ' . $row->id . '<br/>';
        }


    }
}
