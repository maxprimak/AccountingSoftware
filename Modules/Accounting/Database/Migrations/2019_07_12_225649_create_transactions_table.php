<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id');
            $table->bigInteger('cashbox_id');
            $table->bigInteger('expenditure_item_id');
            $table->bigInteger('contractor_id');
            $table->bigInteger('responsible_id');
            $table->bigInteger('status_id');
            $table->date('transaction_date');
            $table->string('note');
            $table->double('amount', 8, 2);
            $table->timestamps();
            //TODO: foreign keys
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
