<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNextOfKin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('relationship');
            $table->string('address', 225);
            $table->integer('phone');
            $table->integer('memberId');

            $table->foreign('memberId')->references('registration')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kin');
    }
}
