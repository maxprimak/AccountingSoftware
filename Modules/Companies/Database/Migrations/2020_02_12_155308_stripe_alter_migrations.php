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
        
        /*Schema::table('subscriptions', function (Blueprint $table) {
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('user_id')->nullable()->change();
            $table->foreign('company_id')->references('id')->on('companies');
        });*/

        Schema::table('companies', function(Blueprint $table){
            $table->string('stripe_id');
            $table->string('card_brand');
            $table->string('card_last_four', 4);
            $table->date('trial_ends_at');
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
