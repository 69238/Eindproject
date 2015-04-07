<?php

class PaymentController extends \BaseController {

	Public function index(){

		//Pak alle informatie op de banklist pagina en decode het
		$jsonData = json_decode(file_get_contents('http://payme.ict-lab.nl/api/banklist/'));

		//stop de informatie in een array met de banklist als key
		foreach($jsonData as $key => $banklist){
			$banken[] = $banklist;
		}

		return View::make('producten.betaling', ['jsonData' => $jsonData, 'banken' => $banken]);
	}

	Public function betaal(){

		$member_id = Auth::user()->id;
		//Queries
		$order_detail = OrderDetail::where('member_id', $member_id)
							->where('order_status', 2)
								->where('deleted', 0)->first();

		$product_voorraad = OrderDetail::where('member_id', $member_id)
								->join('orders', 'orders.order_id', '=', 'order_detail.id')
									->join('product', 'orders.product_id', '=', 'product.id')
										->where('order_status', 2)
											->where('order_detail.deleted', 0)->get();



		if($order_detail) {

			//definieer de essentiele informatie voor de url die gemaakt moet worden
			$pmid = "zufb6qxsxn";
			$pmkey = "qm88ejs59b8k7ax6ssf7borfp5a378ih";

			//pak de banknaam en totaal bedrag
			$totaal = str_replace('.', '', $order_detail->total);
			$bank_id = Input::get('banken');

			//betalingskenmerk is een vast getal met als laatst een willekeurig getal tussen 0 en 9
			$betalingskenmerk = '301258740006138' . strval(rand('0', '9'));
			$beschrijving = 'Aankoop';

			//vervang in de succes/fout pagina de slashes met hashtags
			$succesUrl = urlencode(str_replace('/', '#', 'http://69238.lux.ict-lab.nl/betaling/ok'));
			$failedUrl = urlencode(str_replace('/', '#', 'http://69238.lux.ict-lab.nl/betaling/bad'));
			
			//genereer een sha1 van de key betalingskenmerk en totaal bedrag
			$sha1 = sha1($pmid . $pmkey . $betalingskenmerk . $totaal );

			//maak de payurl aan met alle benodigde waardes
			$payUrl = 'http://payme.ict-lab.nl/api/starttrans/' . $pmid . '/' . $pmkey . '/' . $totaal . '/' . $bank_id . '/' . $betalingskenmerk . '/' . $beschrijving . '/' . $succesUrl . '/' . $failedUrl . '/' . $sha1 . '/';

			//decode en pak all alle informatie op de payurl vervolgens define je de transid om in de database te stoppen
			$data = json_decode(file_get_contents($payUrl));
			$transactie_id = $data->transid;

			$order_detail->trans_id = $transactie_id;
			$order_detail->save();

			//Update product voorraad als de voorraad groter is dan het aantal
			if($product_voorraad){
				foreach($product_voorraad as $aantal){
					if($aantal->voorraad > $aantal->aantal){
						$product_id = $aantal->product_id;
						$oud_voorraad = $aantal->voorraad;
						$aantal = $aantal->aantal;

						$nieuw_voorraad = $oud_voorraad - $aantal;

						
						$get_product = Product::where('id','=', $product_id )
													->where('deleted', 0)->update(['voorraad' => $nieuw_voorraad]);
						
					}
				}
			}

			return Redirect::to(urldecode($data->fwdurl));
		} else {
			return Redirect::back()->with('danger', 'Deze bestelling bestaat niet.');
		}
	}

	Public function betaling_ok(){
		$member_id = Auth::user()->id;
		$status = 3;
		//pak de pagina url, explode de url om het in delen te stoppen,
		$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$path_parts= explode('/', $url);
		//pak het 4e deel en haal het eerste stukje tekst uit dit deel om deze in de query als check te gebruiken
		$part4 = $path_parts[4];
		$transactie_id = str_replace('ok?transid=', '' , $part4);

		//Queries
		$bestellingen = Order::join('order_detail', 'orders.order_id', '=', 'order_detail.id')
			->join('product', 'orders.product_id', '=', 'product.id')
				->where('order_detail.deleted', 0)
					->where('member_id',$member_id)
						->where('order_detail.trans_id', $transactie_id)
							->select('orders.order_id','orders.aantal','order_detail.total','order_detail.order_date', 'order_detail.trans_id', 'product.naam', 'product.prijs')->get();
		
		$bestelling_adres = OrderDetail::where('order_detail.deleted', 0)
											->where('member_id', $member_id)
												->where('order_detail.trans_id', $transactie_id)
													->select('order_detail.adres','order_detail.postcode','order_detail.huisnummer','order_detail.toevoegingen')->get();

		$order_detail = OrderDetail::where('member_id', $member_id)
								->where('order_status', 2)
									->where('deleted', 0)
										->where('trans_id', $transactie_id)->first();

		if($order_detail){
			$order_detail->order_status = $status;
			$order_detail->save();
		}

		return View::make('producten.betaling_ok', ['bestellingen' => $bestellingen, 'bestelling_adres' => $bestelling_adres]);
	}

	Public function betaling_bad(){
		return View::make('producten.betaling_bad');
	}

}