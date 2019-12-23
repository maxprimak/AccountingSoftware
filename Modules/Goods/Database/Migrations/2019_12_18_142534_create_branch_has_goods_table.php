<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchHasGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_has_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('good_id');
            $table->unsignedInteger('branch_id');
            $table->timestamps();
        });

        Schema::table('branch_has_goods', function($table) {
          $table->foreign('good_id')->references('id')->on('goods');
          $table->foreign('branch_id')->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch_has_goods');
    }
}
