<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Transactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table)
        {
            $table->integer('user_id');
            $table->string('stock_symbol');
            $table->integer('number');
            $table->float('price');
            $table->boolean('type'); //0 if its buy, 1 if its sell
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //  Schema::dropIfExists('transactions');
    }
}
