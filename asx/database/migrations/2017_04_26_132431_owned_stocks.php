<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OwnedStocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('owned_stocks');

        Schema::create('owned_stocks', function (Blueprint $table) {
            /* Don't think we need to show ID for the portfolio but might need it for referencing purposes
            Comment back in if we need it
            $table->increments('id')->unique(); */
            $table->string('user_id');
            $table->string('stock_symbol');
            $table->integer('number');
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
        Schema::dropIfExists('owned_stocks');
    }
}
