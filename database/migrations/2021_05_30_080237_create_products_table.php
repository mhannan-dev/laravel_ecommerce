<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('section_id')->unsigned()->comment('PK on sections table')->nullable();
			$table->integer('brand_id')->unsigned()->comment('PK on brands table')->nullable();
			$table->integer('category_id')->unsigned()->comment('PK on categories table');
			$table->string('title');
			$table->string('slug');
			$table->string('code')->nullable();
			$table->string('color')->nullable();
			$table->decimal('price', 8, 2);
			$table->float('weight', 5, 2);
			$table->decimal('discount_amt', 5, 2);
			$table->string('image');
			$table->string('fabric');
			$table->string('pattern');
			$table->string('sleeve');
			$table->string('fit');
			$table->string('occasion');
			$table->string('meta_title');
			$table->string('group_code')->nullable();
			$table->text('description')->nullable();
			$table->text('wash_care')->nullable();
			$table->text('meta_description');
			$table->text('meta_keyword');
			$table->enum('is_featured', ['No', 'Yes']);
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
		Schema::dropIfExists('products');
	}
}
