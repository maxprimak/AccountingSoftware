<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('people');

                /* FOR FUTURE USE OF INDEXES
        Schema::table('users', function (Blueprint $table)
        {
            $table->dropIndex(['INSERT_INDEX_HERE']);
        });
        */
    }
}
