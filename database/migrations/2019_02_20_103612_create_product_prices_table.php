<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_prices', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('prd_id');
			$table->foreign('prd_id')->references('id')->on('products');
			
			$table->unsignedInteger('size_id')->nullable();
			$table->foreign('size_id')->references('id')->on('sizes');
			$table->unsignedInteger('color_id')->nullable();
			$table->foreign('color_id')->references('id')->on('colors');
			$table->float('prd_price',10,2);
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
        Schema::dropIfExists('product_prices');
    }
}