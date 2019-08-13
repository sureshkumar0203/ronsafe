<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_bookings', function (Blueprint $table) {
              $table->increments('id');
			  $table->integer('training_id')->unsigned();
			  $table->foreign('training_id')->references('id')->on('trainings');
			  $table->bigInteger('user_id')->unsigned();
              $table->foreign('user_id')->references('id')->on('user_registrations');
			  $table->float('training_price',10,2);
			  $table->string('full_name','191');
			  $table->string('contact_no','20');
			  $table->string('email','191');
			  $table->string('address1','191');
			  $table->string('address2','191')->nullable();;
			  $table->string('city','155');
			  $table->string('post_code','10');
			  $table->string('state','155');
			  $table->string('country','155');
			  $table->string('transaction_id')->nullable();
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
        Schema::dropIfExists('training_bookings');
    }
}
