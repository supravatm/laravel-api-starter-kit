<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CarrierRequest;
use App\Http\Resources\Api\CarrierResource;
use App\Models\Api\OrderDelivery;
use App\Traits\ApiResponse;
use App\Http\Resources\Api\CarrierCollection;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class CarrierController extends Controller
{
    use ApiResponse;

    /**
     * Fetch collections from the database
     *
     * @param Request $request
     * @param [type] $carrierId
     * @return void
     */
    public function getCollections(Request $request, $carrierId)
    {
        $validator = Validator::make(['carrier_id' => $carrierId], [
            'carrier_id' => 'required|integer',
        ],
        [
            'carrier_id.required' => ':carrier_id field is required',
        ]);
        if ($validator->fails()) {
            return $this->error(
                'Validation failed',
                422,
                $validator->messages(),
            );
        }
        $carriers = $this->getOrderByCarrierId($request, $carrierId);
        return new CarrierCollection($carriers);
    }
    /**
     * Collect order by carrier
     *
     * @param Request $request
     * @param int $order_id
     * @return void
     */
    public function collect(Request $request, $orderId)
    {
        $validator = Validator::make(['order_id' => $orderId], [
            'order_id' => 'required|integer'
        ],
        [
            'order_id.required' => 'Order id is required',
        ]);
        if ($validator->fails()) {
            return $this->error(
                'Validation failed',
                422,
                $validator->messages(),
            );
        }
        $carrier = OrderDelivery::where('order_id', $orderId)->first();
        if (!$carrier) {
            return $this->error(
                "Order not found",
                422,
                $validator->messages()
            );
        }
        
        $timeNow = $this->getCurrentDateTime();
        $carrier->collected_at = $timeNow;
        $carrier->save();
        return $this->success(
            [],
            "Carrier collected time is {$timeNow} udpated successfully",
            200
        );
    }
    /**
     * Get order by carrier id
     *
     * @param  Request $request
     * @param  int $carrierId
     */
    private function getOrderByCarrierId(Request $request, int $carrierId)
    {
        return OrderDelivery::where('carrier_id', $carrierId)->paginate(10);
    }
    /**
     * Get the current date and time in UTC
     *
     * @return  string
     */
    private function getCurrentDateTime(): string
    {
        $utcNow = Carbon::now()->setTimezone('UTC');
        return $utcNow->format('Y-m-d H:i:s');
    }
}
