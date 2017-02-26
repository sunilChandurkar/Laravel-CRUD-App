<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'restaurants';

    /**
     * Get the user that created the restaurant.
     */
    public function user(){
    	return $this->belongsTo('App\User');
    }

    /**
     * Get the menu items for this restaurant
     */
    public function menuitems(){
        return $this->hasMany('App\MenuItem');
    }
}
