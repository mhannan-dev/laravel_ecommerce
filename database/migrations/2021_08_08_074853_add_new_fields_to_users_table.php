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
            $table->text('address')->after('name')->nullable();
            $table->string('city')->after('address')->nullable();
            $table->string('state')->after('city')->nullable();
            $table->string('country')->after('state')->nullable();
            $table->string('zip_code')->after('country')->nullable();
            $table->string('mobile')->after('zip_code')->nullable();
            $table->tinyInteger('status')->after('mobile')->nullable()->default(1)->comment('0 = Not activated 1 = Activated');
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
            $table->dropColumn('zip_code');
            $table->dropColumn('mobile');
            $table->dropColumn('status');
        });
    }
}
