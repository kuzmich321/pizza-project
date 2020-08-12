<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'pizza_id', 'quantity', 'price'];

    public function order()
    {
        return $this->belongsTo('App\Order', 'id');
    }

    public function pizza()
    {
        return $this->hasOne('App\Pizza', 'id', 'pizza_id');
    }
}
