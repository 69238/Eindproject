<?php

class OrderDetailController extends \BaseController {

	Public function index(){
		$member_id = Auth::user()->id;
		$mem_id = Auth::user();
		$order = OrderDetail::all();
		$order_get = OrderDetail::Producten($mem_id->id);

		$product_id = Input::get('id');
		$count = Order::join('order_detail', 'order_detail.id', '=', 'orders.order_id')
		->where('orders.deleted', 0)
			->where('orders.product_id', $product_id)
				->where('order_detail.member_id', $member_id)->count();

		if($order_get){
			$cart_producten = Order::join('product', 'orders.product_id', '=', 'product.id')
									->where('order_id', $order_get->id)
										->where('orders.deleted', 0)
											->where('product.deleted', '=', 0)
												->select('orders.id','orders.aantal','orders.prijs', 'product.naam', 'product.prijs')->get();

			$cart_total = Order::join('order_detail', 'order_detail.id', '=', 'orders.order_id')
								->where('orders.order_id', $order_get->id)
									->where('order_detail.member_id',$member_id)
										->where('orders.deleted', 0)->sum('prijs');

			return View::make('producten.cart', ['cart_producten' => $cart_producten, 'cart_total' => $cart_total, 'order' => $order, 'mem_id' => $mem_id, 'member_id' => $member_id]);
		}else{
			return View::make('producten.cart', ['cart_producten' => null, 'cart_total' => null, 'order' => $order]);
		}
	}	

	Public function add(){

		if(! OrderDetail::isValid(Input::all())){
			return Redirect::back()->with('danger', 'Het product kan niet toegevoegd worden.');
		}

		$product_id = Input::get('id');
		$aantal = Input::get('aantal');

		$product = Product::find($product_id);

		if($product['voorraad'] < $aantal){
			return Redirect::back()->with('warning', 'Het product heeft niet zoveel meer in voorraad.');
		}

		$total = $aantal * $product['prijs'];

		if(Auth::check())
		{
			$member_id = Auth::user()->id;
			$mem_id = Auth::user();
			$order = OrderDetail::Producten($mem_id->id);

			$count = Order::join('order_detail', 'order_detail.id', '=', 'orders.order_id')
							->where('orders.deleted', 0)
								->where('order_status', '!=', 3)
									->where('orders.product_id', $product_id)
										->where('order_detail.member_id', $member_id)->count();
		}else{
			return Redirect::to('sessions/login')->with('warning', 'U moet ingelogd zijn om gebruik te maken van de winkelwagen.');
		}

		if($count){
			return Redirect::back()->with('warning', 'Het product bestaat al in uw winkelwagen.');
		}else{

			if($order){
				//Maak een order detail aan als er al een order is
				$orders = new Order;
				$orders->product_id = $product_id;
				$orders->order_id = $order->id;
				$orders->aantal = $aantal;
				$orders->prijs = $total;
				$orders->save();

			}else{
				//Maak een order en een order detail aan als geen van beide bestaan
				$order_details = new OrderDetail;
				$order_details->member_id = $member_id;
				$order_details->order_status = 1;
				$order_details->total = 0;
				$order_details->save();

				$orders = new Order;
				$orders->product_id = $product_id;
				$orders->order_id = $order_details->id;
				$orders->aantal = $aantal;
				$orders->prijs = $total;
				$orders->save();
			}
		}
			/*$cart_producten = OrderDetail::with('Producten')
							->where('member_id','=', $member_id)->get();*/

			return Redirect::route('cart')->with('success', 'Product toevoegen in de cart succesvol verlopen.');
		
			return Redirect::route('cart')->with('danger', 'Product toevoegen in de cart is niet succesvol verlopen.');
		
	}

	public function destroy()
	{
    	$product_get = Order::find(Input::get('id'));
    	$member_id = Auth::user()->id;
    	$product_id = Input::get('id');
    	$status = 0;

		$cart_total = Order::join('order_detail', 'order_detail.id', '=', 'orders.order_id')
			->where('order_detail.member_id',$member_id)
				->where('orders.deleted', 0)->sum('prijs');

		$count = Order::join('order_detail', 'order_detail.id', '=', 'orders.order_id')
				->where('orders.deleted', 0)
					->where('orders.product_id', $product_id)
						->where('order_detail.member_id', $member_id)->count();

    	if($product_get == true){
    		$product_get->deleted = 1;
    		$product_get->save();

	    	/*if($count == (int)0){
	    		//Update status naar 0
				$order_get = OrderDetail::where('member_id','=', $member_id)
								->where('deleted','=','0')
									->update(['order_status' => $status]);
			}*/
				//Update status van de order details
			$order_get = OrderDetail::where('member_id','=', $member_id)
										->where('deleted','=','0')
											->update(['total' => $cart_total]);
	    	

    		return Redirect::back()->with('success', 'Product verwijderen succesvol verlopen.');
		}else{
			return Redirect::back()->with('danger', 'Product verwijderen niet succesvol verlopen.');
		}
	}
}