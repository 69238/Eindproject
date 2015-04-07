<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableProduct extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product', function($field) {
			$field->increments('id');
			$field->integer('categoryid')->unsigned();
			$field->string('naam', 100);
			$field->text('omschrijving');
			$field->decimal('prijs', 7, 2);
			$field->integer('voorraad')->unsigned();
			$field->string('thumbnail', 255);
			$field->softDeletes();
			$field->timestamps();
			$field->boolean('deleted');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('product');
	}

}
