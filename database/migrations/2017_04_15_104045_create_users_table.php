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
            $table->integer('registration')->unique();
            $table->string('surname', 30);
            $table->string('firstName', 30);
            $table->string('middleName', 30);
            $table->string('phone')->unique()->index();
            $table->string('email')->nullable()->unique();
            $table->enum('sex', ['male', 'female']);
            $table->date('dob')->nullable();
            $table->enum('maritalStatus', ['married', 'single', 'divorced', 'widowed'])->nullable();
            $table->string('address', 225)->nullable();
            $table->string('permanentAddress')->nullable();
            $table->string('occupation')->nullable();
            $table->string('status');
            $table->string('image')->nullable();
            $table->string('password');
            $table->integer('role');
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
        Schema::dropIfExists('users');
    }
}
