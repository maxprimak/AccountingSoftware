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
        });

        /* FOR FUTURE USE OF INDEXES
        Schema::table('users', function(Blueprint $table)
        {
            $table->index('INSERT_INDEX_HERE');
        }); 
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');

        /* FOR FUTURE USE OF INDEXES
        Schema::table('users', function (Blueprint $table)
        {
            $table->dropIndex(['INSERT_INDEX_HERE']);
        }); 
        */
    }
}
