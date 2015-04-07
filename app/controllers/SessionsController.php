<?php

class SessionsController extends BaseController{

	public function create(){

		if(Auth::check()){
			if(!Auth::user()->isAdmin()){
				return Redirect::to('/');
			}else{
				return Redirect::to('/cms');
			}
		}
		
		return View::make('sessions.login');
	}

	public function store(){

		$credentials = [
            'username' => Input::get('username'),
            'password' => Input::get('password'),
            'confirmed' => 1
        ];

		if(Auth::attempt($credentials)){
			return Redirect::to('sessions/login')->with("Welkom " . Auth::user()->username);
		}else{
			return Redirect::back()->with('danger','Login mislukt');
		}
	}

	public function destroy(){
		Auth::logout();

		return Redirect::to('sessions/login');
	}
}