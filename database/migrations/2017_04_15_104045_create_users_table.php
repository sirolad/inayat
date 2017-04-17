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
            $table->increments('id');
            $table->bigInteger('registration')->unique()->nullable();
            $table->string('surname', 30)->nullable();
            $table->string('firstName', 30)->nullable();
            $table->string('middleName', 30)->nullable();
            $table->bigInteger('phone')->unique()->index();
            $table->string('email')->nullable()->unique();
            $table->enum('sex', ['male', 'female'])->nullable();
            $table->date('dob')->nullable();
            $table->enum('maritalStatus', ['married', 'single', 'divorced', 'widowed'])->nullable();
            $table->string('address', 225)->nullable();
            $table->string('permanentAddress')->nullable();
            $table->string('occupation')->nullable();
            $table->string('status')->nullable();
            $table->string('image')->nullable();
            $table->string('password')->nullable();
            $table->integer('role')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role')->references('id')
                ->on('roles')->
                onUpdate('cascade')
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role']);
        });

        Schema::dropIfExists('users');
    }
}
