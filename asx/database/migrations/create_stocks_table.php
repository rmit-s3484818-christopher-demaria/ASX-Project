<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/04/2017
 * Time: 6:21 PM
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    public function up()
    {
        Schema::create('stocks', function($table)
        {
            $table->increments('id');
            $table->string('symbol',20);
            $table->string('name');
            $table->string('exchange');
            $table->string('ipo_year');
            $table->string('sector');
            $table->string('industry');
            $table->string('last_sale');
            $table->string('market_cap');
            $table->string('summary_link');
            $table->timestamp('updated_at');
        });
    }

    public function down()
    {
        Schema::drop('stocks');
    }
}