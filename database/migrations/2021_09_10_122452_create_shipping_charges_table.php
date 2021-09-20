<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_charges', function (Blueprint $table) {
            $table->id();
            $table->string('country_name')->default(10.00);
            $table->float('till_500gm')->default(10.00);
            $table->float('till_1000gm')->default(10.00);
            $table->float('till_2000gm')->default(10.00);
            $table->float('above_5000gm')->default(10.00);
            $table->tinyInteger('status')->default('1')->comment('1 = active and 0 = inactive');
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
        Schema::dropIfExists('shipping_charges');
    }
}
