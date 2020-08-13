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
            $pizza->image = "https://laravel-blog-1337.s3.eu-north-1.amazonaws.com/pizzas/pizza-{$pizza->id}.svg";
        }

        return new PizzaCollection($pizzas);
    }
}
