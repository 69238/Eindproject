<?php

class Cart extends Eloquent{

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

	//Stel relatie vast met de product tabel
	/*Public static function Producten($id){
		return Order::where('member_id', $id)->where('order_status', 1)->where('deleted', 0)->select('id')->first();
	}

	Public function Producten(){
		return $this->belongsTo('Product', 'product_id');
	}

	//Stel relatie vast met de orders tabel
	Public function Orders(){
		return $this->belongsTo('Order', 'member_id');
	}*/

	Public function orderItems(){
		return $this->belongsToMany('Product')->withPivot('aantal', 'total');
	}

	Public static function Producten($id){
		return Cart::where('member_id', $id)->where('order_status', 1)->where('deleted', 0)->select('id')->first();
	}
}