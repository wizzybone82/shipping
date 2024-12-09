<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateShippingOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('shipping_orders', function (Blueprint $table) {
            // Add new columns
            $table->enum('weight_metric', ['gram', 'kg'])->nullable()->after('package_weight');
            $table->integer('number_of_items')->nullable()->after('weight_metric');

            // Update package_size column to be an enum
            $table->enum('package_size', ['small', 'large', 'extra_large'])->nullable()->default(null)->change();
        });
    }

    public function down()
    {
        Schema::table('shipping_orders', function (Blueprint $table) {
            // Remove the added columns
            $table->dropColumn('weight_metric');
            $table->dropColumn('number_of_items');

            // Revert package_size column back
            $table->string('package_size')->nullable()->change();
        });
    }
}
