<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PizzaCollection;
use App\Pizza;
use Illuminate\Support\Facades\Storage;

class PizzaController extends Controller
{
    public function __invoke()
    {
        $pizzas = Pizza::all();

        foreach ($pizzas as $pizza) {
            $pizza->image = Storage::disk('s3')->url("pizzas/pizza-{$pizza->id}.svg");;
        }

        return new PizzaCollection($pizzas);
    }
}
