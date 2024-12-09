<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCanceledByToShippingOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('shipping_orders', function (Blueprint $table) {
            // Add canceled_by column
            $table->enum('canceled_by', ['user', 'admin'])->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('shipping_orders', function (Blueprint $table) {
            // Drop canceled_by column
            $table->dropColumn('canceled_by');
        });
    }
}
