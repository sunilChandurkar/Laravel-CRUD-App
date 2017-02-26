<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menuitems';

    /**
     * Get the user that created the restaurant.
     */
    public function user(){
    	return $this->belongsTo('App\User');
    }

    /**
     * Get the restaurant that this menuitem belongs to.
     */
    public function restaurant(){
    	return $this->belongsTo('App\Restaurant');
    }
}
