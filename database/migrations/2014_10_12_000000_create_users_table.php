<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id',10);
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('age');
            $table->string('email',30)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('contact_no');
            $table->integer('level_id');
            $table->string('password');
            $table->string('profile_photo');
            $table->enum('role',[1,2,3,4]);
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
        Schema::dropIfExists('users');
    }
}
