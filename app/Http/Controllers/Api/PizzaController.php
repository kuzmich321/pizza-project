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

        foreach ($pizzas as $pizza) {
            $pizza->image = getenv('AWS_URL') . "/pizzas/pizza-{$pizza->id}.svg";
        }

        return new PizzaCollection($pizzas);
    }
}
