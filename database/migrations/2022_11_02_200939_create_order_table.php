<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function(Blueprint $table) {

            $table->increments('id');
            $table->string('order_ref');
            $table->integer('status');
            $table->unsignedBigInteger('user_id');
            $table->string('user_fullname');
            $table->string('user_email');
            $table->timestamps();

            // foreign key
            // $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
