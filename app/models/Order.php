<?php

class Order extends Eloquent{

	//Define table(waarbij de class default op staat)
	protected $table = 'orders';

	public static $errors;

	protected $guarded = array();

	//sla timestamps op in de db
	public $timestamps = true;

	//Maak de rules voor de form elementen
	public static $rules = [
		'adres'    		=> 'required',
		'postcode'    	=> 'required',
		'huisnummer'    => 'required',
		'toevoegingen'  => 'required'
	];

	//Maak een isvalid functie die checkt of alle form elementen die de errors variable gebruiken
	//ook inderdaad voldoen aan de rules
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
		return OrderDetail::where('member_id', $id)->where('order_status', 1)->where('deleted', 0)->select('id')->first();
	}
}