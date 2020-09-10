<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('item_id');
            $table->string('total');
            $table->string('description');
            //$table->foreign('user_id')->references('id')->on('users');
            //$table->foreign('item_id')->references('id')->on('items');
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
        Schema::dropIfExists('invoices');
    }
}
