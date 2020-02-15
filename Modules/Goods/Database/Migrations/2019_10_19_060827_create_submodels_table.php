<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmodelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submodels', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('model_id');
            $table->string('name');
            $table->tinyInteger('is_custom')->default(0);
            $table->timestamps();
        });

        Schema::table('submodels', function($table) {
          $table->foreign('model_id')->references('id')->on('models');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submodels');
    }
}
