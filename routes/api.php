<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(function () {
    Route::prefix('auth')->group(function() {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('logout', 'AuthController@logout')->middleware('jwt.auth');
        Route::post('guest', 'AuthController@getOrCreateGuest');

        Route::get('me', 'AuthController@me')->middleware('jwt.auth');
    });

    Route::get('/pizzas', 'PizzaController');

    Route::get('/orders/history', 'OrderController@history')->middleware('jwt.auth');
    Route::apiResource('/orders', 'OrderController')->except(['index', 'show']);

    Route::apiResource('/order_items', 'OrderItemController')->except(['index', 'show']);
});
