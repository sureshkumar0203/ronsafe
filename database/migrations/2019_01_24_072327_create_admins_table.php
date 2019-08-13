<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('admin_id');
			$table->string('admin_name');
            $table->string('email')->unique();
            $table->string('alt_email');
           	$table->string('password');
			$table->boolean('active_status');
			$table->string('contact_no',14);
			$table->string('mobile_no',14);
			$table->string('address',255);
			$table->string('facebook_url',200)->nullable();
			$table->string('twitter_url',200)->nullable();
			$table->string('instagram_url',200)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
