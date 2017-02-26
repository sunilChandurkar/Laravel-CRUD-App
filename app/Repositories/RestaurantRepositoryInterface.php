<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface RestaurantRepositoryInterface{

	public function getAll();

	public function find($id);

	public function storeRestaurant(Request $request);

	public function updateRestaurant(Request $request, $id);

	public function destroyRestaurant($id);

	public function getEntrees($id);

	public function getAppetizers($id);

	public function getDesserts($id);

}