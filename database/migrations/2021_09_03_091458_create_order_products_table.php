<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->comment('Order primary key');
            $table->integer('user_id')->comment('User primary key');
            $table->integer('product_id')->comment('Product primary key');
            $table->string('product_name');
            $table->string('product_color');
            $table->string('product_size');
            $table->string('product_code');
            $table->decimal('product_price', 10, 2);
            $table->string('product_qty');
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
        Schema::dropIfExists('order_products');
    }
}
