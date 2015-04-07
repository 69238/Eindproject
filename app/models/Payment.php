<?php

class Payment extends Eloquent{

	protected $guarded = array();

	public static $rules = [

	];

	public static $errors;

	public static function isValid($data){

		$validation = Validator::make($data, static::$rules);
	
		if ($validation->passes()) return true;

		static::$errors = $validation->messages();

		return false;
	}
}