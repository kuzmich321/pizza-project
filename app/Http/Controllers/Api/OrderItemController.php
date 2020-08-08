<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\OrderItem;

class OrderItemController extends Controller
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
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|integer',
            'pizza_id' => 'required|integer',
            'quantity' => 'required|integer',
            'price' => 'required|integer'
        ]);

        OrderItem::create($validatedData);

        return response()->json([
            'status' => 'Order item has been created'
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param OrderItem $orderItem
     * @return void
     */
    public function update(Request $request, OrderItem $orderItem)
    {
        $validatedData = $request->validate([
            'quantity' => 'integer',
            'price' => 'integer'
        ]);

        $orderItem->update($validatedData);

        return response()->json([
            'status' => 'Order item has been updated'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param OrderItem $orderItem
     * @return void
     */
    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();

        return response()->json([
            'status' => 'Order item has been deleted'
        ], Response::HTTP_OK);
    }
}
