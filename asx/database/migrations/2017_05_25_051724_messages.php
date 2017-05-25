<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Messages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table)
        {
            $table->integer('sender_id');
            $table->integer('receiver_id');
            $table->string('message');
            $table->float('money');
            $table->boolean('read'); //0 if its unread, 1 if it has been read
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
        //  Schema::dropIfExists('messages');
    }
}
