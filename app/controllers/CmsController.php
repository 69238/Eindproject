<?php

class CmsController extends BaseController {

	public function index() {
		return View::make('cms.index');
	}

	public function product(){
		$producten = Product::all();
		
		return View::make('cms.product', ['producten' => $producten]);
	}

	public function single($id) {
		$product = Product::find($id);
		return View::make('cms.single', ['product' => $product]);
	}

}
