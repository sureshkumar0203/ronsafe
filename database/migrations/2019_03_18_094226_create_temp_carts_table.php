<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_carts', function (Blueprint $table) {
			$table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('session_id',255);
			
			$table->unsignedInteger('price_id');
			$table->foreign('price_id')->references('id')->on('product_prices');
			
			$table->string('size',255)->nullable();
			$table->string('color',255)->nullable();
			  
            $table->decimal('unit_price', 10, 2);
            $table->integer('qty');
            $table->decimal('total_price', 10, 2);
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
        Schema::dropIfExists('temp_carts');
    }
}
