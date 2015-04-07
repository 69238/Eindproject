<?php

/* Home Routes */
Route::get('/', 'HomeController@index');

/* Sessions */
Route::get('sessions/login', 'SessionsController@create');
Route::post('sessions/login', 'SessionsController@store');
Route::get('sessions/logout', 'SessionsController@destroy');
Route::get('sessions', 'SessionsController');

/* Product Routes */
Route::get('producten', 'ProductenController@index');
Route::get('producten/create', 'ProductenController@create');
Route::post('producten/create', 'ProductenController@store');
Route::get('producten/{id}', 'ProductenController@show');
Route::get('producten/{id}/edit', 'ProductenController@edit');
Route::post('producten/{id}/edit', 'ProductenController@update');

/* Cart Routes */
Route::get('cart', [
	'before' => 'auth.check',
	'as'=>'cart',
	'uses' => 'OrderDetailController@index'
]);

Route::post('cart/add',[
	'before' => 'auth.check',
	'uses'   =>'OrderDetailController@add'
]);

Route::post('cart/destroy',[
	'before' => 'auth.check',
	'uses'   =>'OrderDetailController@destroy'
]);

/* Order Routes */
Route::post('cart/order',[
	'before' => 'auth.check',
	'uses'   =>'OrderController@order'
]);

/* Payment Routes */
Route::get('betaling', 'PaymentController@index');
Route::get('betaling/ok/', 'PaymentController@betaling_ok');
Route::get('betaling/bad/', 'PaymentController@betaling_bad');
Route::post('betaling', 'PaymentController@betaal');

/* User Routes */
Route::get('users', 'UserController@index');
Route::get('users/create', 'UserController@create');
Route::post('users/create', 'UserController@store');

/* E-mail activation */
Route::get('users/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'UserController@confirm'
]);

/* User CMS */
Route::group(array('before' => 'auth'), function() { 
	Route::get('users/overzicht', 'UserController@overzicht');
	Route::get('users/profile/{id}', 'UserController@profile');
	Route::get('users/bestellingen', 'UserController@bestellingen');
	Route::get('users/bestellingen/{id}/{order_id}', 'UserController@bestel_show');
	Route::post('users/profile/update',[
		'before' => 'auth.check',
		'uses'   =>'UserController@update'
	]);
});

/* CMS & Admin */
Route::group(array('before' => 'admin'), function() { 
	Route::post('producten/destroy', 'ProductenController@destroy');

	Route::get('cms/product', 'CmsController@product');
	Route::get('cms/{id}', 'CmsController@single');
	Route::get('cms', 'CmsController@index');
});

/* 404 */
App::missing(function($exception) {
	return Response::view('home.404', [], 404);
});