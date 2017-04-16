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
        Schema::create('kins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('relationship');
            $table->string('kin_address', 225);
            $table->integer('kin_phone');
            $table->integer('memberId');
            $table->timestamps();

            $table->foreign('memberId')->references('registration')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
