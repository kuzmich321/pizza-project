<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\OrderItem;
use Illuminate\Support\Facades\Validator;

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
        $validatedData = Validator::make($request->all(), [
            'data.*.order_id' => 'required|integer',
            'data.*.pizza_id' => 'required|integer',
            'data.*.quantity' => 'required|integer',
            'data.*.price' => 'required|integer'
        ])->validated();

        foreach ($validatedData['data'] as $orderItemValidation) {
            OrderItem::create($orderItemValidation);
        }

        return response()->json([
            'status' => 'Order items have been created'
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
