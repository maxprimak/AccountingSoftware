<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKostenvoranschlagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kostenvoranschlags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('kost29')->default(0);
            $table->string('date')->nullable();
            $table->string('shop')->nullable();
            $table->string('shop_tel')->nullable();
            $table->string('shop_email')->nullable();
            $table->string('web')->nullable();
            $table->string('kundenbetreuer')->nullable();
            $table->string('zahlungsmodalitat')->nullable();
            $table->string('kunde')->nullable();
            $table->string('kunde_tel')->nullable();
            $table->string('kunde_email')->nullable();
            $table->string('text_head')->nullable();
            $table->string('text_body')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kostenvoranschlags');
    }
}
