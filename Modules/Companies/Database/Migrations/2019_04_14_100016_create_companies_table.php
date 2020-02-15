<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('phone');
            $table->integer('tax');
            $table->unsignedInteger('currency_id');
            $table->unsignedInteger('language_id')->default(1);
            $table->unsignedInteger('address_id');
            $table->string('stripe_id')->nullable()->collation('utf8mb4_bin')->index();
            $table->string('card_brand')->nullable();
            $table->string('card_last_four', 4)->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            //$table->unsignedInteger('package_id');
            $table->timestamps();
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('address_id')->references('id')->on('addresses');
            //$table->foreign('package_id')->references('id')->on('packages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
