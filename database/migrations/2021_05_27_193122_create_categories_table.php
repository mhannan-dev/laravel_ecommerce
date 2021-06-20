<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->integer('section_id');
            $table->string('title');
            $table->string('slug');
            $table->string('image');
            $table->decimal('discount_amt', 5, 2);
            $table->text('description');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->tinyInteger('status')->comment('1=Active and 0=Inactive')->default('1')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
