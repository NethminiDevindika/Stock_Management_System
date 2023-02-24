<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('srn_no')->unsigned();
            $table->foreign('srn_no')->references('id')->on('return_headers');
            $table->unsignedBigInteger('product')->unsigned();
            $table->foreign('product')->references('id')->on('products');
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
        Schema::dropIfExists('return_details');
    }
}
