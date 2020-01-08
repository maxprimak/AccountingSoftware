<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTypesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_types_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('order_type_id');
            $table->unsignedInteger('language_id');
            $table->timestamps();
        });

        Schema::table('order_types_translations', function($table) {
          $table->foreign('order_type_id')->references('id')->on('order_types');
          // $table->foreign('language_id')->references('id')->on('languages');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_types_translations');
    }
}
