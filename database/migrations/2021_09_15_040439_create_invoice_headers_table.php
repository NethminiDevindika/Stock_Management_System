<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
      *@return void
     */
    public function up()
    {
        Schema::create('invoice_headers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice')->nullable();
            $table->string('description')->nullable();
            $table->double('cost_price')->nullable();
            $table->integer('qty')->nullable();
           
            $table->string('remark')->nullable();
            $table->double('total_amount')->nullable();
           
           
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
        Schema::dropIfExists('invoice_headers');
    }
}
