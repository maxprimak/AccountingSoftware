<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaufvertragsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kaufvertrags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('telefon')->nullable();
            $table->string('adresse')->nullable();
            $table->string('ort_plz')->nullable();
            $table->tinyInteger('mobil')->default(0);
            $table->tinyInteger('tablet')->default(0);
            $table->string('modell')->nullable();
            $table->string('imei')->nullable();
            $table->string('text_body', 2000)->nullable();
            $table->string('ort_datum')->nullable();
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
        Schema::dropIfExists('kaufvertrags');
    }
}
