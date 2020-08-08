<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_ID_CANCELLED = 0;
    const STATUS_ID_CREATED = 1;
    const STATUS_ID_PAYED = 2;
    const STATUS_ID_FINISHED = 3;

    protected $fillable = ['user_id', 'city', 'street', 'house', 'apartment', 'total', 'status'];

    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
