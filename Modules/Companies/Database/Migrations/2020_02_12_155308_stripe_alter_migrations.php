<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StripeAlterMigrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('user_id')->nullable()->change();
            $table->foreign('company_id')->references('id')->on('companies');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
