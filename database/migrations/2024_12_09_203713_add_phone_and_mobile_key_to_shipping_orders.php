<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneAndMobileKeyToShippingOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipping_orders', function (Blueprint $table) {
            $table->string('phone_number')->nullable()->after('delivery_address');
            $table->string('mobile_key')->nullable()->after('phone_number');
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
            $table->dropColumn(['phone_number', 'mobile_key']);
        });
    }
}
