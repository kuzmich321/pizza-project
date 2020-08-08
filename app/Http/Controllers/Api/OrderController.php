<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\Order as OrderResource;
use App\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'city' => 'required|string|max:50',
            'street' => 'required|string|max:50',
            'house' => 'required|integer',
            'apartment' => 'required|integer',
            'total' => 'required|integer'
        ]);

        $validatedData['status'] = Order::STATUS_ID_CREATED;

        Order::create($validatedData);

        return response()->json([
            'status' => 'Order has been created',
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return OrderResource
     */
    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Order $order
     * @return Response
     */
    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'city' => 'string|max:50',
            'street' => 'string|max:50',
            'house' => 'integer',
            'apartment' => 'integer',
            'total' => 'integer',
            'status' => 'integer'
        ]);

        $order->update($validatedData);

        return response()->json([
            'status' => 'Order has been updated'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return void
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
           'status' => 'Order has been deleted'
        ], Response::HTTP_OK);
    }
}
