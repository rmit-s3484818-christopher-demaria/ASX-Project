<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = "stock";
    protected $fillable = ['id', 'symbol', 'name','exchange','ipo_year','sector','industry','last_sale','market_cap','summary_link','updated_at'];
}
