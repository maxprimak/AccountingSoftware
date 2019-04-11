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
            $table->string('date');
            $table->string('shop');
            $table->string('shop_tel');
            $table->string('shop_email');
            $table->string('web');
            $table->string('kundenbetreuer');
            $table->string('zahlungsmodalitat');
            $table->string('kunde');
            $table->string('kunde_tel');
            $table->string('kunde_email');
            $table->string('text_head');
            $table->string('text_body');
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
