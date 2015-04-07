<?php

class OrderDetail extends Eloquent{

	protected $table = 'order_detail';

	protected $guarded = array();

	public static $rules = [
		'aantal' => 'required|numeric', 
		'id' => 'required|numeric|exists:product,id' //id bestaat in de product table
	];

	public static $errors;

	public static function isValid($data){

		$validation = Validator::make($data, static::$rules);
	
		if ($validation->passes()) return true;

		static::$errors = $validation->messages();

		return false;
	}

	//Maak een public static functie producten die de informatie uit order_detail
	// ophaalt met de volgende fields waarbij de member_id in de pagina te vinden
	// moet zijn en gelijk moet staan aan de gene in de DB
	Public static function Producten($id){
		return OrderDetail::where('member_id', $id)->where('order_status', 1)->orWhere('order_status', 2)->where('deleted', 0)->select('id')->first();
	}
}