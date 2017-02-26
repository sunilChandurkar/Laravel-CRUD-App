<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider{

	public function register(){
\App::bind('App\Repositories\RestaurantRepositoryInterface', 'App\Repositories\DbRestaurantRepository');
\App::bind('App\Repositories\MenuItemRepositoryInterface', 'App\Repositories\DbMenuItemRepository');
	}

}