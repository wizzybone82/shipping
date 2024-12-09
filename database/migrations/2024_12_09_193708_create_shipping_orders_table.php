<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('shipping_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('package_size');
            $table->float('package_weight');
            $table->timestamp('delivery_time');
            $table->timestamp('pickup_time');
            $table->enum('status', ['pending', 'inprogress', 'delivered'])->default('pending');
            $table->string('pickup_city');
            $table->string('pickup_address');
            $table->string('delivery_city');
            $table->string('delivery_address');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipping_orders');
    }
}
