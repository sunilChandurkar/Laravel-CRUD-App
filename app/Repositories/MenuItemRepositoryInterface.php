<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface MenuItemRepositoryInterface{

public function find($menu_id);

public function findRestaurant($restaurant_id);

public function storeMenuItem(Request $request, $restaurant_id);

public function updateMenuItem(Request $request, $menu_id);

public function destroyMenuItem($menu_id);

}