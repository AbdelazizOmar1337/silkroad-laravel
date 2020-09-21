<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_web');
            $table->string('description');
            $table->string('name_merchant');
            $table->double('price', 5);
            $table->integer('silk');
            $table->string('currency', 3)->default('USD');
            $table->string('type')->default('fixed_price');

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
        Schema::dropIfExists('donation_types');
    }
}
