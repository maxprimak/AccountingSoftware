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
            $table->string('name');
            $table->string('telefon');
            $table->string('adresse');
            $table->string('ort_plz');
            $table->tinyInteger('mobil')->default(0);
            $table->tinyInteger('tablet')->default(0);
            $table->string('modell');
            $table->string('imei');
            $table->string('text_body', 2000);
            $table->string('ort_datum');
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
