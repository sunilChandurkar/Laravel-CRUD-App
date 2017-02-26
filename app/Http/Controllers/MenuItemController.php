<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Restaurant;

use App\MenuItem;

use App\Repositories\MenuItemRepositoryInterface;

class MenuItemController extends Controller
{
    protected $item;

    public function __construct(MenuItemRepositoryInterface $item){
        $this->item = $item;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('/menuitems/create', ["restaurant_id"=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $restaurant_id)
    {

        $this->validate_input($request);
        //if input is valid

        $this->item->storeMenuItem($request, $restaurant_id);

        \Session::flash('message', 'Successfully created a new menu item.!');
        return redirect('/restaurant/'. $restaurant_id . '/menu/');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($restaurant_id, $menu_id)
    {
        //get the restaurant
        $restaurant = $this->item->findRestaurant($restaurant_id);
        //get the menuitem
        $menuitem = $this->item->find($menu_id);        
        return view('/menuitems/edit')->with(['menuitem'=>$menuitem, 'restaurant'=>$restaurant]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $restaurant_id, $menu_id)
    {
        $this->validate_input($request);
        //if input is valid update

        $this->item->updateMenuItem($request, $menu_id);

        \Session::flash('message', 'Successfully updated a menu item.!');
        return redirect('/restaurant/'. $restaurant_id . '/menu/');
    }

    public function confirmDelete($restaurant_id, $menu_id){
        //get the menu item
        $menuitem = $this->item->find($menu_id);  
        //get the restaurant
        $restaurant = $this->item->findRestaurant($restaurant_id);
        return view('/menuitems/delete', ['menuitem'=>$menuitem, 'restaurant'=>$restaurant]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($restaurant_id, $menu_id)
    {
        //delete the menu item
        $this->item->destroyMenuItem($menu_id);

        \Session::flash('message', 'Successfully deleted a menu item.!');
        return redirect('/restaurant/'. $restaurant_id . '/menu/');
    }

    /**
     * Validation function
     * @param \Illuminate\Http\Request  $request
     * @return bool
     */
    public function validate_input(Request $request){
        //validate input
        $this->validate($request, [
        'item-name' => 'required|max:100',
        'item-price' => 'required|numeric',
        'course' => 'required',
        'item-description'=> 'required|max:500'
            ]);
    }
}
