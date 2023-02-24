<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrnDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grn_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('grn_no')->unsigned();
            $table->unsignedBigInteger('product')->unsigned();
            $table->integer('qty');
            $table->double('cost_price');
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
        Schema::dropIfExists('grn_details');
    }
}
