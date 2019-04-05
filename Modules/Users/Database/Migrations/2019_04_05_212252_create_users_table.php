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
            $table->unsignedInteger('login_id');
            $table->unsignedInteger('person_id');
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('branch_id');
            $table->timestamps();
            $table->foreign('login_id')->references('id')->on('logins');
            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('role_id')->references('id')->on('roles');
            // $table->foreign('branch_id')->references('id')->on('users');
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
