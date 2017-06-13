<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Watchlist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watchlist', function (Blueprint $table) {
            $table->string('user_id');
            $table->string('stock_symbol');
            $table->float('curr_stock_price');
            $table->float('percentage_change'/*,5,2 if we want to limit to 5 digits 2 of which is behind decimal*/);
            $table->date('date_added');
            $table->date('date_expire');
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
