<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('item_name');
            $table->string('item_desc', 200);
            $table->double('item_price', 5);
            $table->integer('item_silk');
            $table->string('item_currency', 3)->default('USD');
            $table->string('item_type')->default('fixed_price');
            
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
        Schema::dropIfExists('items');
    }
}
