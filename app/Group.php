<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
  	{
   		return $this->hasMany('App\Order');
  	}

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
  	public function users()
  	{
   		
   		return $this->hasMany('App\User');
  	}
}