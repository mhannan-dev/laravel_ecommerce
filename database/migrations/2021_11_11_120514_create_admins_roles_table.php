<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins_roles', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->comment('PK of admins table');
            $table->string('module');
            $table->tinyInteger('view_access')->comment('Can view only');
            $table->tinyInteger('edit_access')->comment('Can view and edit only');
            $table->tinyInteger('full_access')->comment('Can view, edit and delete');
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
        Schema::dropIfExists('admins_roles');
    }
}
