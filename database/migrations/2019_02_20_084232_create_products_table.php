<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
			$table->increments('id');
            $table->unsignedInteger('prd_cat_id');
			$table->foreign('prd_cat_id')->references('id')->on('categories');
			$table->string('prd_name', 255);
			$table->string('prd_slug', 255);
			$table->string('prd_photo', 255);
			$table->longText('prd_details')->nullable();
			$table->boolean('active_status');
			$table->integer('prd_cs_opt');
			$table->string('prd_meta_title', 255);
            $table->string('prd_meta_keyword', 255)->nullable();
            $table->text('prd_meta_description')->nullable();
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
