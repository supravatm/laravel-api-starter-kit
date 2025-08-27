<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\ProductResource;

class CarrierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->is('api/*')) {
            return [
                'id' => $this->id,
                'carrier_id' => $this->carrier_id,
                'order_id' => $this->order_id,
                'user_id' => $this->user_id,
                'slot' => $this->slot,
                'delivery_route_id' => $this->delivery_route_id,
                'product_id' => $this->product_id,
                'product_name' => $this->product->name,
                'product_description' => $this->product->description,
                'product_image' => $this->product?->images?->where('default', true)->first()?->path,
                'quantity' => $this->quantity,
                'status' => $this->status,
            ];
        }
        return parent::toArray($request);
    }
}
