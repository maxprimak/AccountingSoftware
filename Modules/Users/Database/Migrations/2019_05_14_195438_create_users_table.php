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
            $table->unsignedInteger('login_id')->unique();
            $table->unsignedInteger('person_id');
            $table->unsignedInteger('company_id')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
            $table->timestamps();
            $table->foreign('login_id')->references('id')->on('logins')->onDelete('cascade');
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
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

        /* FOR FUTURE USE OF INDEXES
        Schema::table('users', function (Blueprint $table)
        {
            $table->dropIndex(['INSERT_INDEX_HERE']);
        });
        */
    }
}
