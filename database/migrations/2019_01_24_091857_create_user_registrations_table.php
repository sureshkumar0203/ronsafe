<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		protected $fillable = ['full_name','email','password','contact_no','address1','address2','city','post_code','state','country','active_status'];
		
		
        Schema::create('user_registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('full_name',155);
			$table->string('email')->unique();
			$table->string('password',200);
			$table->string('contact_no',15)->unique();
			$table->string('address1',255);
			$table->string('address2',155)->nullable();
			$table->string('city',155);
			$table->string('post_code',10);
			$table->string('state',155);
			$table->string('country',155);
			$table->boolean('active_status')->default(0);
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
        Schema::dropIfExists('user_registrations');
    }
}
