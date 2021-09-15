<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddColumnsToShippingChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipping_charges', function (Blueprint $table) {
            $table->float('till_500gm')->after('country_name')->default(10.00);
            $table->float('till_1000gm')->after('till_500gm')->default(10.00);
            $table->float('till_2000gm')->after('till_1000gm')->default(10.00);
            $table->float('till_3000gm')->after('till_2000gm')->default(10.00);
            $table->float('till_4000gm')->after('till_3000gm')->default(10.00);
            $table->float('till_5000gm')->after('till_4000gm')->default(10.00);
        });
    }
    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::table('shipping_charges', function (Blueprint $table) {
            $table->dropColumn('till_500gm');
            $table->dropColumn('till_1000gm');
            $table->dropColumn('till_2000gm');
            $table->dropColumn('till_3000gm');
            $table->dropColumn('till_4000gm');
            $table->dropColumn('till_5000gm');
        });
    }
}
