<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('branch_id');
            $table->unsignedInteger('category_id');
            // $table->bigInteger('brand_id');
            $table->unsignedInteger('model_id');
            $table->integer('amount');
            $table->double('price', 8, 2);
            $table->timestamps();

            // $table->string('supplier_stock');
            // $table->date('expected_delivery');
            // $table->bigInteger('location_id');
            //TODO: foreign keys
        });

        Schema::table('goods', function($table) {
          $table->foreign('branch_id')->references('id')->on('branches');
          $table->foreign('category_id')->references('id')->on('goods_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');

    }
}
