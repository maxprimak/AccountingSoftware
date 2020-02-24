<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSuppliersLogic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Run only this migration:
        //php artisan migrate --path=Modules/Suppliers/Database/Migrations/2020_02_18_082818_add_suppliers_logic.php

        Schema::dropIfExists('supplier_orders');

        Schema::table('suppliers', function (Blueprint $table) {
            $table->string('name')->change();
            $table->string('phone')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('comment', 700)->nullable()->change();
            $table->dropColumn('address_id');
        });

        Schema::create('supplier_has_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('address_id');
            $table->unsignedInteger('supplier_id');
            $table->timestamps();

            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });

        Schema::create('supplier_has_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('supplier_id');

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });

        Schema::create('orders_to_supplier_statuses', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('hex_code');
            $table->timestamps();
        });

        Schema::create('orders_to_suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->date('delivery_date');
            $table->string('order_nr');
            $table->unsignedInteger('accepted_by');
            $table->unsignedInteger('orders_to_supplier_statuses_id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('supplier_id');
            $table->string('comment');
            $table->timestamps();

            $table->foreign('accepted_by')->references('id')->on('employees');
            $table->foreign('orders_to_supplier_statuses_id', 'statuses_id_foreign_to_suppliers')->references('id')->on('orders_to_supplier_statuses');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });

        Schema::create('orders_to_supplier_has_goods', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('orders_to_supplier_id');
            $table->unsignedInteger('good_id');
            $table->integer('amount');
            $table->timestamps();

            $table->foreign('orders_to_supplier_id', 'orders_to_supplier_id_foreign')->references('id')->on('orders_to_suppliers');
            $table->foreign('good_id')->references('id')->on('goods');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('supplier_has_addresses');
        Schema::dropIfExists('supplier_has_companies');
        Schema::dropIfExists('orders_to_supplier_statuses');
        Schema::dropIfExists('orders_to_supplier_statuses_translations');
        Schema::dropIfExists('orders_to_supplier_has_goods');
        Schema::dropIfExists('orders_to_suppliers');
    }
}
