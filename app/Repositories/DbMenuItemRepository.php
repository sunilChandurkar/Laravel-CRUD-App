<?php

namespace App\Repositories;

use Illuminate\Http\Request;

use App\Restaurant;

use App\MenuItem;

use Illuminate\Support\Facades\Auth;

use App\Repositories\MenuItemRepositoryInterface;

class DbMenuItemRepository implements MenuItemRepositoryInterface{

//find a menu item by id

public function find($menu_id){

return MenuItem::findOrFail($menu_id);

}

//find a restaurant by id
public function findRestaurant($restaurant_id){
	return Restaurant::findOrFail($restaurant_id);
}

/**
 * Store a newly created menuitem
 * @param  \Illuminate\Http\Request  $request
 * @param int $restaurant_id
 */
public function storeMenuItem(Request $request, $restaurant_id){

	        //Create a new MenuItem instance
            $menuitem = new MenuItem;            
            $menuitem->name = $request->input('item-name');
            $menuitem->price = $request->input('item-price');
            $menuitem->course = $request->input('course');
            $menuitem->description = $request->input('item-description');
            $menuitem->restaurant_id = $restaurant_id;
            $menuitem->user_id = Auth::id();
            $menuitem->save();

}

/**
 * update a menuitem
 * @param  \Illuminate\Http\Request  $request
 * @param int $menu_id
 */
public function updateMenuItem(Request $request, $menu_id){

        //get the menuitem
        $menuitem = MenuItem::findOrFail($menu_id);
        $menuitem->name = $request->input('item-name');
        $menuitem->price = $request->input('item-price');
        $menuitem->course = $request->input('course');
        $menuitem->description = $request->input('item-description');
        $menuitem->save();

}

public function destroyMenuItem($menu_id){
        //get the menu item
        $menuitem = MenuItem::findOrFail($menu_id);
        $menuitem->delete();
}

}