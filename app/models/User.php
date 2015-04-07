<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	public static $errors;

	protected $table = 'users';

	public $timestamps = true;

	public function isAdmin(){
		return (int)$this->admin === (int)1;
	}

	public static $rules = [
		'geslacht'    	=> 'required', 
		'voornaam'      => 'required',
		'achternaam'    => 'required',
		'adres'    		=> 'required',
		'postcode'    	=> 'required',
		'huisnummer'    => 'required',
		'toevoegingen'  => 'required',
		'telefoon'    	=> 'required',
		'username' 		=> 'required|unique:users', 
		'password' 		=> 'required|min:8',
		'email'   		=> 'required|email|unique:users'
	];

	public static $rules_profile = [
		'geslacht'    	=> 'required', 
		'voornaam'      => 'required',
		'achternaam'    => 'required',
		'adres'    		=> 'required',
		'postcode'    	=> 'required',
		'huisnummer'    => 'required',
		'toevoegingen'  => 'required',
		'telefoon'    	=> 'required',
		'email'   		=> 'required|email'
	];


	public static function isValid($data){

		$validation = Validator::make($data, static::$rules);
	

		if ($validation->passes()) return true;

		static::$errors = $validation->messages();

		return false;
	}

	public static function profileValid($data){

		$validation = Validator::make($data, static::$rules_profile);
	

		if ($validation->passes()) return true;

		static::$errors = $validation->messages();

		return false;
	}

}
