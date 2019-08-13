<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user_registrations');
            $table->string('full_name', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('contact_no', 255)->nullable();
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();
            $table->string('city', 255)->nullable();
            $table->string('post_code', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->float('total_amount',10,2)->nullable();
            $table->float('shipping_amount',10,2)->nullable();
            $table->float('grand_total',10,2)->nullable();
            $table->string('transaction_id',255)->nullable();
            $table->string('payment_status',255)->nullable();
            $table->integer('order_status',255)->nullable();
            $table->text('order_notes')->nullable();
            $table->date('ship_date')->nullable();
            $table->string('shipping_url', 255)->nullable();
            $table->string('tracking_id', 255)->nullable();
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
        Schema::dropIfExists('master_orders');
    }
}
