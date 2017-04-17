<?php

namespace App\Http\Controllers;

use App\asx;
use Illuminate\Http\Request;
use Excel;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;

class ExcelController extends Controller
{
    public function ExportClients()
    {
        Excel::create('clients', function($excel){
           $excel->sheet('clients', function($sheet){
               $sheet->loadView('pages.market');
            });

        })->export('csv');

    }
    public function upload()
    {
        return view('upload');
    }

    public function ImportClients()
    {
        $file = Input::file('file');
        $file_name = $file->getClientOriginalName();
        $file->move('files', $file_name);
        Excel::load('files/'.$file_name)->each(function (Collection $csvLine)
        {
            asx::create([
                'name' => $csvLine->get('name'),
                'symbol' => $csvLine->get('symbol'),
                'company' => $csvLine->get('company'),
            ]);
        });


    }

}
