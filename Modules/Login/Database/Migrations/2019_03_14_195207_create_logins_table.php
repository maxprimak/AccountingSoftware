<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('password');
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
        Schema::dropIfExists('logins');

        /* FOR FUTURE USE OF INDEXES
        Schema::table('users', function (Blueprint $table)
        {
            $table->dropIndex(['INSERT_INDEX_HERE']);
        }); 
        */
    }
}
