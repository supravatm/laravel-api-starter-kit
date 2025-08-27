<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CarrierResource;
use Illuminate\Http\Request;
use App\Http\Resources\Api\OrderResource;
use App\Http\Resources\Api\OrderCollection;
use App\Models\Api\Order;
use App\Models\Api\OrderDelivery;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    use ApiResponse;
    /**
     * Fetch order from the database
     *
     * @param Request $request
     * @param int $carrierId
     * @return void
     */
    public function getCollections(Request $request, $carrierId)
    {
        $validator = Validator::make(['carrier_id' => $carrierId], [
            'carrier_id' => 'required|integer'
        ],
        [
            'carrier_id.required' => ':attribute field is required',
        ]);
        if ($validator->fails()) {
            return $this->error(
                'Validation failed',
                422,
                $validator->messages(),
            );
        }
        
        $carrier = $this->getOrderByCarrierId($request, $carrierId);

        return new OrderCollection($carrier);

    }
    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $order = Order::whereHas('carrier.address')->find($id);
        if(!$order)
        {
            return $this->error(
                'Order not found',
                422
            );
        }
        return $this->success(
            new OrderResource($order),
            'Order retrieved successfully', 
            200
        );
    }
    /**
     * Update order status
     *
     * @param Request $request
     * @param Order $order
     * @return void
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:delivered,cancelled',
        ]);

        if ($validator->fails()) {
            return $this->error(
                'Validation failed',
                422,
                $validator->messages()
            );
        }
        $order->status = $request->input('status');
        $order->save();

        return $this->success(
            [],
            'Order status updated successfully', 
            200
        );
    }
    /**
     * Update order status
     *
     * @param Request $request
     * @param OrderDelivery $carrier
     * @return void
     */
    public function collect(Request $request, $orderId)
    {
        $validator = Validator::make($request->all(), [
            'bottle_collected' => 'required|int|in:0,1',
        ]);

        if ($validator->fails()) {
            return $this->error(
                'Validation failed',
                422,
                $validator->messages()
            );
        }
        $bottleCollected = $request->input('bottle_collected');
        $orderDelivery = OrderDelivery::where('order_id', $orderId)->first();
        if ($orderDelivery) {
            $orderDelivery->update(['bottle_collected' => $bottleCollected]);
            return $this->success(
                [],
                'Order updateded successfully', 
                200
            );
        }
        return $this->error(
            "Order with number {$orderId} not found.",
            422,
            $validator->messages()
        );
    }
    /**
     * Get order by order id
     *
     * @param  Request $request
     * @param  int $orderId
     */
    private function getOrderById(Request $request, int $orderId)
    {
        $order = Order::with('carrier')->find($orderId);
        if(!$order)
        {
            return $this->error(
                'Order not found',
                422
            );
        }
        return $this->success(
            new OrderResource($order),
            'Order retrieved successfully', 
            200
        );
    }
    /**
     * Get order Collection by order id
     *
     * @param  Request $request
     * @param  int $carrierId
     */
    private function getOrderByCarrierId(Request $request, int $carrierId)
    {
        $order = Order::whereHas('carrier', function ($query) use ($carrierId) {
            $query->where('carrier_id', $carrierId);
        })->paginate(10);
        return $order;
    }
    
}
