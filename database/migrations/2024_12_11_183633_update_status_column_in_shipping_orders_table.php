<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateStatusColumnInShippingOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Update the status column ENUM values
        DB::statement("ALTER TABLE `shipping_orders` MODIFY COLUMN `status` ENUM('pending', 'on route', 'shipped', 'in progress', 'delivered', 'cancelled')");

        // Update existing rows from 'inprogress' to 'in progress'
        DB::table('shipping_orders')
            ->where('status', 'inprogress')
            ->update(['status' => 'in progress']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert the status column to its previous ENUM values
        DB::statement("ALTER TABLE `shipping_orders` MODIFY COLUMN `status` ENUM('pending', 'inprogress', 'delivered', 'cancelled')");

        // Revert rows back to 'inprogress'
        DB::table('shipping_orders')
            ->where('status', 'in progress')
            ->update(['status' => 'inprogress']);
    }
}
