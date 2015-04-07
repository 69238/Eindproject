<?php

class OrderController extends \BaseController {

/* AANTAL */
	Public function order(){

		if(! Order::isValid(Input::all())){
			return Redirect::back()->withInput()->withErrors(Order::$errors);
		}

		//Define alle gets
		$member_id    = Auth::user()->id;
		$mem_id = Auth::user();
		$date = Carbon\Carbon::now();
		$order_get = OrderDetail::Producten($mem_id->id);
		$status = 2;

		$adres = Input::get('adres');
		$huisnummer = Input::get('huisnummer');
		$toevoegingen = Input::get('toevoegingen');
		$postcode = Input::get('postcode');

		//Maak een query om de order en order details op te halen door de overeenkomsten tussen de 2
		$cart_total = Order::join('order_detail', 'order_detail.id', '=', 'orders.order_id')
								->where('orders.order_id', $order_get->id)
									->where('order_detail.member_id',$member_id)
										->where('orders.deleted', 0)->sum('prijs');

		/* 
			Status 0 = Geen status
			Status 1 = In cart
			Status 2 = Ordered maar niet betaald
			Status 3 = Betaald
			---- Eventueel ---
			Status 4 = Verzonden
			Status 5 = Ontvangen
		*/

		//Update status van de order details
		$order_get = OrderDetail::where('member_id','=', $member_id)
									->where('order_status', '1')
										->where('deleted','0')
											->update(['order_date' => $date, 'order_status' => $status, 'total' => $cart_total, 
												'adres' => $adres, 'huisnummer' => $huisnummer, 'toevoegingen' => $toevoegingen, 'postcode' => $postcode ]);

		// Als de update goed verloopt redirect je naar de view met een goed berichtje anders slecht
		if($order_get){
			return Redirect::to('betaling')->with('success', 'Product order succesvol verlopen.');
		}else{
			return Redirect::back()->with('danger', 'Product order niet succesvol verlopen');
		}
	}
}