<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRechnungItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rechnung_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('artikelbeschreibung');
            $table->integer('menge');
            $table->double('preis');
            $table->bigInteger('rechnung_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('rechnung_id')->references('id')->on('rechnung_hand_difs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rechnung_items');
    }
}
