<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//JSON APIs to view Restaurant Information

//Shows the Menu of a particular restaurant in JSON
Route::get('/restaurant/{restaurant_id}/menu/JSON', function ($restaurant_id) {
    return "Menu of Restuarant ID " . $restaurant_id . "in JSON.";
})->where('restaurant_id', '[0-9]+');


//Shows the description of a menu item in JSON
Route::get('/restaurant/{restaurant_id}/menu/{menu_id}/JSON', function($restaurant_id, $menu_id){
	return " JSON Restaurant ID is " . $restaurant_id . " and Menu ID is " . $menu_id;
})->where(['restaurant_id'=>'[0-9]+', 'menu_id'=>'[0-9]+']);

//Shows the names of all restaurants in JSON
Route::get('/restaurants/JSON', function(){
	return "All restaurants in JSON.";
});


//Shows all restaurants
Route::get('/', 'RestaurantController@index');

//Form to Create a new restaurant
Route::get('/restaurant/new/', 'RestaurantController@create')->middleware('auth');

//Create a new restaurant in the database
Route::post('/restaurant/new/', 'RestaurantController@store')->middleware('auth');

//Form to Edit a restaurant
Route::get('/restaurant/{restaurant_id}/edit/', 
		   'RestaurantController@edit')->where('restaurant_id', '[0-9]+')->middleware('auth');

//Edit a restaurant in the database
Route::post('/restaurant/{restaurant_id}/edit/', 
			'RestaurantController@update')->where('restaurant_id', '[0-9]+')->middleware('auth');

//Form to Delete a restaurant
Route::get('/restaurant/{restaurant_id}/delete/', 
		   'RestaurantController@confirmDelete')->where('restaurant_id', '[0-9]+')->middleware('auth');

//Delete a restaurant in the database
Route::post('/restaurant/{restaurant_id}/delete/', 
			'RestaurantController@destroy')->where('restaurant_id', '[0-9]+')->middleware('auth');

//Show a restaurant menu
Route::get('/restaurant/{restaurant_id}/menu/', 
		   'RestaurantController@show')->where('restaurant_id', '[0-9]+');

//Form to Create a new menu item
Route::get('/restaurant/{restaurant_id}/menu/new/', 
		   'MenuItemController@create')->where('restaurant_id', '[0-9]+')->middleware('auth');

//Create a new menu item
Route::post('/restaurant/{restaurant_id}/menu/new/', 
			'MenuItemController@store')->where('restaurant_id', '[0-9]+')->middleware('auth');

//Form to Edit a menu item
Route::get('/restaurant/{restaurant_id}/menu/{menu_id}/edit', 
		   'MenuItemController@edit')->where(['restaurant_id'=>'[0-9]+', 'menu_id'=>'[0-9]+'])->middleware('auth');

//Edit a menu item
Route::post('/restaurant/{restaurant_id}/menu/{menu_id}/edit', 
	        'MenuItemController@update')->where(['restaurant_id'=>'[0-9]+', 'menu_id'=>'[0-9]+'])->middleware('auth');

//Form to Delete a menu item
Route::get('/restaurant/{restaurant_id}/menu/{menu_id}/delete', 
		   'MenuItemController@confirmDelete')->where(['restaurant_id'=>'[0-9]+', 'menu_id'=>'[0-9]+'])->middleware('auth');

//Delete a menu item
Route::post('/restaurant/{restaurant_id}/menu/{menu_id}/delete', 
			'MenuItemController@destroy')->where(['restaurant_id'=>'[0-9]+', 'menu_id'=>'[0-9]+'])->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index');

