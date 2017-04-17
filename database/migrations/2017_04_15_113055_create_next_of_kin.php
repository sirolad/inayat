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
            $table->integer('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::table('kins', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('kins');
    }
}
