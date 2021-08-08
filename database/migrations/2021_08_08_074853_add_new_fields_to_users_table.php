<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddNewFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('address')->after('name');
            $table->string('city')->after('address');;
            $table->string('state')->after('city');;
            $table->string('country')->after('state');;
            $table->string('pin_code')->after('country');;
            $table->string('mobile')->after('pin_code');;
            $table->tinyInteger('status')->after('mobile');;
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('country');
            $table->dropColumn('pin_code');
            $table->dropColumn('mobile');
            $table->dropColumn('status');
        });
    }
}
