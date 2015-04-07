<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function($field) {
			$field->increments('id');
			//$field->integer('member_id');
			$field->integer('order_id');
			$field->integer('product_id');
			$field->integer('aantal');
			//$field->decimal('total', 7, 2);
			$field->decimal('prijs', 7, 2);
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
		Schema::dropIfExists('carts');
	}

}
