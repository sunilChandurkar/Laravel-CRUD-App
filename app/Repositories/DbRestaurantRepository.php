<?php

namespace App\Repositories;

use Illuminate\Http\Request;

use App\Restaurant;

use App\MenuItem;

use Illuminate\Support\Facades\Auth;

use App\Repositories\RestaurantRepositoryInterface;

class DbRestaurantRepository implements RestaurantRepositoryInterface {

	//returns all Restaurants
	public function getAll(){
		return Restaurant::all();
	}

	/**
	 * @param int $id
	 * @return App\Restaurant with the given $id
	 */
	public function find($id){
		return Restaurant::findOrFail($id);
	}

	/**
     * Store a newly created restaurant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
	public function storeRestaurant(Request $request){
        //Create a new Restaurant instance
        $restaurant = new Restaurant;
        //get the user input restaurant name
        $name = $request->input('restaurant-name');
        $restaurant->name = $name;
        //get the authenticated user's id
        $user_id = Auth::id();
        $restaurant->user_id = $user_id;
        //save the restaurant in the db
        $restaurant->save();
	}

	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
	public function updateRestaurant(Request $request, $id){
		//find the restaurant with the given id
        $restaurant = Restaurant::find($id);

        //get the user input restaurant name
        $name = $request->input('restaurant-name');
        $restaurant->name = $name;
        $restaurant->save(); 
	}

	/**
     * Remove the specified restaurant from storage.
     *
     * @param  int  $id
     * 
     */
    public function destroyRestaurant($id){
	    //find the restaurant with the given id
        $restaurant = Restaurant::find($id); 
        $restaurant->delete();    	
    }

    /**
     * Get entrees in the restaurant
     * @param  int  $id
     * @return App\MenuItem - entrees
     */
    public function getEntrees($id){
    	$restaurant = Restaurant::find($id);
    	return MenuItem::where(['restaurant_id'=>$restaurant->id, 'course'=>'entree'])->get();
    }

    /**
     * Get appetizers in the restaurant
     * @param  int  $id
     * @return App\MenuItem - appetizers
     */
    public function getAppetizers($id){
    	$restaurant = Restaurant::find($id);
    	return MenuItem::where(['restaurant_id'=>$restaurant->id, 'course'=>'appetizer'])->get();
    }

    /**
     * Get desserts in the restaurant
     * @param  int  $id
     * @return App\MenuItem - desserts
     */
    public function getDesserts($id){
    	$restaurant = Restaurant::find($id);
    	return MenuItem::where(['restaurant_id'=>$restaurant->id, 'course'=>'dessert'])->get();
    }

}