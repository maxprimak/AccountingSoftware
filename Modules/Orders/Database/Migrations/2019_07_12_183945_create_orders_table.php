<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->date("accept_date");
            $table->double("price");
            $table->unsignedInteger("branch_id");
            $table->timestamps();
            $table->unsignedInteger("created_by");
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('created_by')->references('id')->on('logins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
