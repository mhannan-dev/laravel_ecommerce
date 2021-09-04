<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->integer('zip_code');
            $table->integer('mobile');
            $table->string('email')->nullable();
            $table->string('shipping_charges');
            $table->string('coupon_code');
            $table->decimal('coupon_amount', 10, 2);
            $table->string('order_status');
            $table->string('payment_gateway');
            $table->string('payment_method');
            $table->decimal('grand_total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
