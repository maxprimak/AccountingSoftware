<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBarcode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouse_has_goods', function($table) {
            $table->string('barcode_id')->nullable();
            // $table->foreign('barcode_id')->references('id')->on('barcodes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouse_has_goods', function($table) {
            $table->string('barcode_id')->nullable();
        });
    }
}
