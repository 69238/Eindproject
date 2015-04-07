<?php

class HomeController extends BaseController {

	public function index() {
		$producten = Product::all();
		return View::make('home.index', ['producten' => $producten]);;

	}
}
