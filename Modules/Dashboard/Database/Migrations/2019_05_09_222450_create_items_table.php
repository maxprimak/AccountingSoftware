<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('artikelbeschreibung');
            $table->integer('menge');
            $table->double('preis');
            $table->bigInteger('kostenvoranschlag_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('kostenvoranschlag_id')->references('id')->on('kostenvoranschlags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
