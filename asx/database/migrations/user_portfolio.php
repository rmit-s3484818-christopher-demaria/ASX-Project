<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createPortfolioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio', function (Blueprint $table) {
            /* Don't think we need to show ID for the portfolio but might need it for referencing purposes
            Comment back in if we need it
            $table->increments('id')->unique(); */
            $table->string('name');
            $table->string('email')->unique();
            $table->string('ownedStocks');
            /* If we need to put it in/include this feature
            $table->string('favouritedStocks'); */
            $table->decimal('currentMoney', 10, 2);
            $table->decimal('netWorth',10,2);
            $table->rememberToken();
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
        Schema::dropIfExists('portfolio');
    }
}
