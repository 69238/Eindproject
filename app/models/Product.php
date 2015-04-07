<?php

class Product extends Eloquent{

	public static $errors;

	protected $table = 'product';

	protected $softDelete = true;

	public $timestamps = true;

	protected $guarded = array();

	public static $rules = [
		'naam' => 'required', 
		'omschrijving' => 'required', 
		'prijs' => 'required', 
		'voorraad' => 'required',
		'thumbnail' => 'required'  
	];

	public static function isValid($data){

		$validation = Validator::make($data, static::$rules);
	

		if ($validation->passes()) return true;

		static::$errors = $validation->messages();

		return false;
	}
}
