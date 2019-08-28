<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairOrderHasWarrantiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_order_has_warranties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id');
            $table->bigInteger('warranty_id');
            $table->timestamps();
            //TODO: foreign keys
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_order_has_warranties');
    }
}
