<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Restaurant;

use App\Repositories\RestaurantRepositoryInterface;

use Illuminate\Support\Facades\Auth;

use \App\MenuItem;

class RestaurantController extends Controller
{
    protected $restaurant;

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
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find the restaurant with the given id
        $restaurant = $this->restaurant->find($id);
        return view('/restaurants/edit', ['restaurant'=>$restaurant]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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

    public function confirmDelete($id){
        //find the restaurant with the given id
        $restaurant = $this->restaurant->find($id);   
        return view('/restaurants/delete', ['restaurant'=>$restaurant]);
    }
}
