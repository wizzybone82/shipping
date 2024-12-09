<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateShippingOrdersTableForPackageWeightAndSize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipping_orders', function (Blueprint $table) {
            // Make package_weight nullable
            $table->float('package_weight')->nullable()->change();

            // Update the package_size enum to include 'medium'
            $table->enum('package_size', ['small', 'large', 'extra_large', 'medium'])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipping_orders', function (Blueprint $table) {
            // Revert package_weight to non-nullable
            $table->float('package_weight')->nullable(false)->change();

            // Revert package_size enum back to the original values
            $table->enum('package_size', ['small', 'large', 'extra_large','medium'])->nullable()->change();
        });
    }
}
