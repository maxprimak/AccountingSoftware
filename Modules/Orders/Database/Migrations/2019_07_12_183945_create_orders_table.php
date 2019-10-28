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
            $table->bigIncrements('id');
            $table->bigInteger('created_by');
            $table->bigInteger('status_id');
            $table->double('total_sum', 8, 2);
            $table->boolean('paid');
            $table->bigInteger('customer_id');
            $table->bigInteger('branch_id');
            $table->bigInteger('payment_method_id');
            $table->bigInteger('discount_code_id');
            $table->string('comment');
            $table->timestamps();
            //TODO: foreign_keys
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
