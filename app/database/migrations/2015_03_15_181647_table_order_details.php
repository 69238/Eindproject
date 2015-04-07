<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableOrderDetails extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/*Schema::create('order_detail', function($field) {
			$field->increments('id');
			$field->integer('order_id');
			$field->integer('product_id');
			$field->integer('aantal');
			$field->decimal('total', 10, 2);
			$field->string('adres', 255);
			$field->string('postcode', 7);
			$field->string('huisnummer', 12);
			$field->string('toevoegingen', 12);
			$field->softDeletes();
			$field->timestamps();
			$field->boolean('deleted');
		});*/
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('order_detail');
	}

}
