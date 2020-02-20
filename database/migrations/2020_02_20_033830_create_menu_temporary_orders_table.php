<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTemporaryOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_temporary_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_name');
            $table->integer('quantity');
            $table->string('order_item');
            $table->double('price',6,2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_temporary_orders');
    }
}
