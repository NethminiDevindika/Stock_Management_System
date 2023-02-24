<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category')->unsigned();
            $table->foreign('category')->references('id')->on('categories');
            $table->unsignedBigInteger('brand')->unsigned();
            $table->foreign('brand')->references('id')->on('brands');
            $table->unsignedBigInteger('supplier')->unsigned();
            $table->foreign('supplier')->references('id')->on('suppliers');
            $table->string('description');
            $table->double('cost_price');
            $table->unsignedBigInteger('unit')->unsigned();
            $table->foreign('unit')->references('id')->on('units');
            $table->integer('reorder_level');
            $table->string('img_url')->nullable();
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
        Schema::dropIfExists('products');
    }
}
