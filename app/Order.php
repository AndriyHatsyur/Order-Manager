<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'teil', 'parent_id', 'group_id', 'zonder'
    ];

    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function children()
    {
        return $this->hasMany('App\Order', 'parent_id');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
