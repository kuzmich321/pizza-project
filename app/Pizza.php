<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $fillable = ['name', 'description', 'price'];

    public function orderItem()
    {
        return $this->belongsTo('App\OrderItem');
    }
}
