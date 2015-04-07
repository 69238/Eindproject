<?php

class ProductenController extends \BaseController {
	
	public function index() {
		$producten = Product::all();
		return View::make('producten.index', ['producten' => $producten]);
	}

	public function show($id) {
		$product = Product::find($id);

		$voorraad = $product['voorraad'];
		$aantal = Input::get('aantal');

		return View::make('producten.show', ['product' => $product, 'voorraad' => $voorraad]);
	}

	public function create(){
		return View::make('producten.create');
	}

	public function store(){

		if(! Product::isValid(Input::all())){
			return Redirect::back()->withInput()->withErrors(Product::$errors);
		}

		$product = new Product;
		$product->naam = Input::get('naam');
		$product->omschrijving = Input::get('omschrijving');
		$prijs = Input::get('prijs') . '.' . Input::get('comma');
		$product->prijs = $prijs;
		$product->voorraad = Input::get('voorraad');

		$product->thumbnail = Input::file('thumbnail');
		$file = Input::file('thumbnail');
		$image_naam = time() . '-' . $product->naam . '.' . $file->getClientOriginalExtension();

		$file = $file->move('../public_html/images/', $image_naam);
		$product->thumbnail = $image_naam;
		chmod($file, 0755);

		$product->save();

		return Redirect::to('/cms/product')->with('success', 'Product toevoegen succesvol verlopen');
	}

	public function destroy()
	{
    	$product_get = Product::find(Input::get('id'));

    	if($product_get == true){
    		$product_get->deleted = 1;
    		$product_get->save();

    		return Redirect::to('/cms/product')->with('success', 'Product verwijderen succesvol verlopen');
		}else{
			return Redirect::to('/cms/product')->with('danger', 'Product verwijderen niet succesvol verlopen');
		}
	}

	public function edit($id){
		$product = Product::findOrFail($id);

		return View::make('producten.edit', compact('product'));
	}

	public function update($id){
		$product = Product::findOrFail($id);

		$product->naam = Input::get('naam');

		$product->omschrijving = Input::get('omschrijving');
		$prijs = str_replace(',', '.', Input::get('prijs'));
		$product->prijs = $prijs;
		$product->voorraad = Input::get('voorraad');

		if (Input::hasFile('thumbnail'))
		{

			$product->thumbnail = Input::file('thumbnail');
			$file = Input::file('thumbnail');
			$image_naam = time() . '-' . $product->naam . '.' . $file->getClientOriginalExtension();

			$file = $file->move('../public_html/images/', $image_naam);
			$product->thumbnail = $image_naam;
			chmod($file, 0755);
		}

		$product->save();

		return Redirect::to('/cms/product')->with('success', 'Product bewerken succesvol verlopen');
	}
}