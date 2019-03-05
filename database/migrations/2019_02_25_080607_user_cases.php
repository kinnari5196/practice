<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserCases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cases',function(Blueprint $table){

        $table->increments('user_cases_id');
        $table->integer('level_id');
        $table->integer('disease_id');
        $table->text('description');
        $table->string('medical_certi')->nullable();
        $table->timestamps();
        $table->integer('id');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
