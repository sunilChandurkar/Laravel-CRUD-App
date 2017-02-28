<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Restaurant;

use App\Repositories\RestaurantRepositoryInterface;

use Illuminate\Support\Facades\Auth;

use \App\MenuItem;

use App\User;

class RestaurantController extends Controller
{
    protected $restaurant;

    /**
     * @param Object belonging to an implementation of
     *        RestaurantRepositoryInterface
     */

    public function __construct(RestaurantRepositoryInterface $restaurant){
        $this->restaurant = $restaurant;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //get all restaurants
        $restaurants = $this->restaurant->getAll();
        
        return view('/restaurants/all', ['restaurants'=>$restaurants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('/restaurants/create');
    }

    /**
     * Store a newly created restaurant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //validate input
        $this->validate($request, [
        'restaurant-name' => 'required|max:100'
            ]);

        //create and save a new Restaurant instance
        $this->restaurant->storeRestaurant($request);

        \Session::flash('message', 'Successfully created a new restaurant.!');
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id id of the restaurant
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //find the restaurant
        $restaurant = $this->restaurant->find($id);
        //get the menuitems for this restaurant
        $entrees = $this->restaurant->getEntrees($id);
        $appetizers = $this->restaurant->getAppetizers($id);
        $desserts = $this->restaurant->getDesserts($id);
        return view('/restaurants/show', ['restaurant'=>$restaurant, 'entrees'=>$entrees, 
                    'appetizers'=>$appetizers, 'desserts'=>$desserts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id id of the restaurant
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        //find the User name of the restaurant creator
        $created_by = $this->get_restaurant_creators_name($id);

        //if the user who is trying to edit the restaurant is not
        //the one who created it redirect back
        if(!$this->match_user_ids($id)){
        \Session::flash('message', 'This Restaurant was created by ' . $created_by . 
            '. You can only edit a Restaurant you have created.');
            return back();
        }

        //find the restaurant
        $restaurant = $this->restaurant->find($id);
        return view('/restaurants/edit', ['restaurant'=>$restaurant]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id id of the restaurant
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        //validate input
        $this->validate($request, [
        'restaurant-name' => 'required|max:100'
            ]);

        //update the restaurant
        $this->restaurant->updateRestaurant($request, $id);

        \Session::flash('message', 'Successfully updated a restaurant.!');
        return redirect('/');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //delete the restaurant
        $this->restaurant->destroyRestaurant($id);

        \Session::flash('message', 'Successfully deleted a restaurant.!');
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function confirmDelete($id){
 
        //find the User name of the restaurant creator
        $created_by = $this->get_restaurant_creators_name($id);
        
        //if the user who is trying to delete the restaurant is not
        //the one who created it redirect back
        if(!$this->match_user_ids($id)){
        \Session::flash('message', 'This Restaurant was created by ' . $created_by . 
            '. You can only delete a Restaurant you have created.');
            return back();
        }

        //find the restaurant with the given id
        $restaurant = $this->restaurant->find($id); 

        return view('/restaurants/delete', ['restaurant'=>$restaurant]);
    }

    /**
     * This function matches the User ID of the logged In User
     * with the USer ID of the User who has created the Restaurant.
     * @param int $id id of the restaurant
     * @return bool - true if the ids match, false otherwise
     */
    public function match_user_ids($id){

        //get the user_id of the logged in user
        $logged_in_user_id = Auth::id(); 

        //find the restaurant with the given id
        $restaurant = $this->restaurant->find($id); 

        //get the user_id of the user who created the Restaurant
        $restaurant_creators_user_id = $restaurant->user_id;

        //match the User ID of the logged In User
        //with the USer ID of the User who has created the Restaurant.

        if($logged_in_user_id==$restaurant_creators_user_id){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Get Restaurant Creator's Name
     * @param int $id id of the restaurant
     * @return string - Restaurant Creator's Name
     */
    public function get_restaurant_creators_name($id){

        //find the restaurant with the given id
        $restaurant = $this->restaurant->find($id);

        //find the User name of the restaurant creator
        $created_by = $restaurant->user->name;
        
        return $created_by;
    }
}
