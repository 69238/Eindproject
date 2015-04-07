<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($field) {
			$field->increments('id');
			$field->boolean('titel');
			$field->string('voornaam', 100);
			$field->string('achternaam', 100);
			$field->string('adres', 255);
			$field->string('postcode', 7);
			$field->string('huisnummer', 12);
			$field->string('toevoegingen', 12);
			$field->string('telefoon', 13);
			$field->string('username', 100);
			$field->string('password', 128);
			$field->string('email', 255);
            $field->string('confirmation_code')->nullable();
			$field->rememberToken();
			$field->softDeletes();
			$field->timestamps();
			$field->boolean('confirmed')->default(0);
			$field->boolean('admin');
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
		Schema::drop('users');
	}

}
