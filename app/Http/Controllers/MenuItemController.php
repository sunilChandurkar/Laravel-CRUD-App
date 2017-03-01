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
        //get the creator's name
        $created_by = $this->get_menuitem_creators_name($menu_id);

        //if the user did not create the menu item
        if(!$this->match_user_ids($menu_id)){
        \Session::flash('message', 'This MenuItem was created by ' . $created_by . 
            '. You can only delete a MenuItem you have created.');
            return back();
        }            
              
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
        //get the creator's name
        $created_by = $this->get_menuitem_creators_name($menu_id);

        //if the user did not create the menu item
        if(!$this->match_user_ids($menu_id)){
        \Session::flash('message', 'This MenuItem was created by ' . $created_by . 
            '. You can only delete a MenuItem you have created.');
            return back();
        }

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

    /**
     * This function matches the User ID of the logged In User
     * with the USer ID of the User who has created the MenuItem.
     * @param int $id id of the restaurant
     * @return bool - true if the ids match, false otherwise
     */
    public function match_user_ids($menu_id){

        //get the user_id of the logged in user
        $logged_in_user_id = Auth::id(); 

        //find the menu item with the given menu_id
        $menuitem = $this->item->find($menu_id);

        //get the user_id of the user who created the menuitem
        $menuitem_creators_user_id = $menuitem->user_id;

        //match the User ID of the logged In User
        //with the USer ID of the User who has created the menuitem
        if($logged_in_user_id==$menuitem_creators_user_id){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Get MenuItem Creator's Name
     * @param int $menu_id id of the menuitem
     * @return string - MenuItem Creator's Name
     */
    public function get_menuitem_creators_name($menu_id){

        //find the menuitem with the given id
        $menuitem = $this->item->find($menu_id);

        //find the User name of the restaurant creator
        $created_by = $menuitem->user->name;
        
        return $created_by;
    }

}
