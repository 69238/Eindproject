<?php

class UserController extends \BaseController {
	
	public function index() {
		$users = User::all();
		return View::make('users.index', ['users' => $users]);
	}

	public function overzicht() {
		$users = User::all();
		$member_id = Auth::user()->id;

		return View::make('users.overzicht', ['users' => $users, 'member_id' => $member_id]);
	}

	public function profile($id) {
		$users = User::find($id);
		$member_id = Auth::user()->id;
		$url = 'users/profile/' . $member_id . '/update/';

		return View::make('users.profile', ['users' => $users, 'member_id' => $member_id, 'url' => $url]);
	}

	public function bestellingen() {
		$member_id = Auth::user()->id;
		$users = User::find($member_id);
		
		$bestellingen = OrderDetail::join('users', 'users.id', '=', 'order_detail.member_id')
						->where('member_id',$member_id)
							->select('users.voornaam', 'users.achternaam', 'order_detail.id', 
								'order_detail.order_date', 'order_detail.order_status', 'order_detail.total')->get();

		return View::make('users.bestellingen', ['users' => $users, 'member_id' => $member_id, 'bestellingen' => $bestellingen]);
	}

	public function bestel_show($id){
		$users = User::find($id);
		$member_id = Auth::user()->id;
		//explode de pagina url en pak de order id eruit
		$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$path_parts= explode('/', $url);
		$get_id = $path_parts[6];

		$bestel_overzicht = Order::join('order_detail', 'orders.order_id', '=', 'order_detail.id')
			->join('product', 'orders.product_id', '=', 'product.id')
				->where('orders.deleted', 0)
					->where('order_detail.id', $get_id)
						->where('member_id',$member_id)
							->select('orders.order_id','orders.aantal','orders.prijs','order_detail.total', 'order_detail.trans_id', 'order_detail.adres','order_detail.postcode',
								'order_detail.huisnummer','order_detail.toevoegingen','order_detail.order_date'
									,'order_detail.order_status', 'product.naam', 'product.prijs')->get();
	
		return View::make('users.bestelling_overzicht', ['users' => $users, 'member_id' => $member_id, 'bestel_overzicht' => $bestel_overzicht]);
	}

	public function show($id) {
		$users = User::find($id);
		return View::make('users.show', ['users' => $users]);
	}

	public function create(){
		return View::make('users.create');
	}

	public function store(){

		if(! User::isValid(Input::all())){
			return Redirect::back()->withInput()->withErrors(User::$errors);
		}

		$user = new user;

		$options = array('geslacht');
		foreach ($options as $option)
		{
			$value = Input::has($option) ? '0' : '1';
			$user->titel = Input::get('geslacht');
		}
		$user->voornaam = Input::get('voornaam');
		$user->achternaam = Input::get('achternaam');
		$user->adres = Input::get('adres');
		$user->postcode = Input::get('postcode');
		$user->huisnummer = Input::get('huisnummer');
		$user->toevoegingen = Input::get('toevoegingen');
		$user->telefoon = Input::get('telefoon');
		$user->username = Input::get('username');
		$user->password = Hash::make(Input::get('password'));
		$user->email = Input::get('email');
		$confirmation_code = str_random(255);
		$user->confirmation_code = $confirmation_code;
		Mail::send('email.verify', array('confirmation_code' => $confirmation_code, 'username' => $user->username), function($message) {
            $message->to(Input::get('email'), Input::get('username'))
                ->subject('Confirmeer je email adres.')
                	->from('tvmeinfo@gmail.com','Tv-Me');
        });
		$user->save();

		return Redirect::to('/sessions/login')->with('success', 'Account aanmaken succesvol verlopen. Check je e-mail om je account te activeren.');
	}

	public function confirm($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if ( ! $user)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        return Redirect::to('sessions/login')->with('success','Je hebt je account met success geactiveerd.');
    }

    Public function update(){

    	$member_id = Auth::user()->id;

		if(! User::profileValid(Input::all())){
			return Redirect::back()->withInput()->withErrors(User::$errors);
		}
			$url = 'users/profile/' . $member_id;

			$user = User::find(Input::get('id'));
			$options = array('geslacht');
			foreach ($options as $option)
			{
				$value = Input::has($option) ? '0' : '1';
				$user->titel = Input::get('geslacht');
			}
			$user->voornaam = Input::get('voornaam');
			$user->achternaam = Input::get('achternaam');
			$user->adres = Input::get('adres');
			$user->huisnummer = Input::get('huisnummer');
			$user->toevoegingen = Input::get('toevoegingen');
			$user->postcode = Input::get('postcode');
			$user->telefoon = Input::get('telefoon');
			$user->email = Input::get('email');
			$user->save();

			return Redirect::back()->with('success', 'Uw profiel is met success verandert.');
    }
}