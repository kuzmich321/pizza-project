<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PizzaCollection;
use App\Pizza;

class PizzaController extends Controller
{
    public function __invoke()
    {
        $pizzas = Pizza::all();

        return new PizzaCollection($pizzas);
    }
}
