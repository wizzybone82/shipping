<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateShippingOrdersTableAddCustomerIdAndStatusEnum extends Migration
{
    public function up()
    {
        Schema::table('shipping_orders', function (Blueprint $table) {
            // Add customer_id column
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');

            // Change status enum to include 'cancelled'
            $table->enum('status', ['pending', 'inprogress', 'delivered', 'cancelled'])->default('pending')->change();
        });
    }

    public function down()
    {
        Schema::table('shipping_orders', function (Blueprint $table) {
            // Drop customer_id column
            $table->dropForeign(['customer_id']);
            $table->dropColumn('customer_id');

            // Revert status enum back to the previous values
            $table->enum('status', ['pending', 'inprogress', 'delivered'])->default('pending')->change();
        });
    }
}
