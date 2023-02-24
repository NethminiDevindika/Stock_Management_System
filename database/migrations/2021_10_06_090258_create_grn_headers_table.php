<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrnHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grn_headers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supplier')->unsigned()->nullable();
            $table->foreign('supplier')->references('id')->on('suppliers');
            $table->string('invoice')->nullable();
            $table->double('total_cost')->nullable();
           
            $table->string('remarks')->nullable();
            $table->integer('status');
            $table->softDeletes();
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
        Schema::dropIfExists('grn_headers');
    }
}
