<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
                // order 
                'id' => $this->id,
                'user_name' => $this->carrier?->address?->name,
                'user_phone' => $this->carrier?->address?->phone,
                'order_status' => $this->status,
                'carrier_address_is' => $this->carrier?->address?->id,
                'address' => $this->carrier?->address?->formatted_address,
                // product details
                'product_name' => $this->product?->name,
                'product_image' => $this->product?->images?->where('default', true)->first()?->path,
                'product_unit' => $this->product?->unit,
                'quantity' => $this->quantity,
                'delivery_instruction' => $this->delivery_instruction,
                'delivery_bell' => $this->delivery_bell,
                'delivery_mode' => $this->delivery_mode,
                'bottle_collected' => $this->carrier?->bottle_collected,
                'carrier_id' => $this->carrier?->id,
                'carrier_id' => $this->carrier?->id,
                'carrier_id' => $this->carrier?->id,
    
                'carrier_product_name' => $this->carrier?->product?->name,
                'carrier_product_unit' => $this->carrier?->product?->unit,
                'carrier_product_quantity' => $this->carrier?->quantity,
                'carrier_bell' => $this->carrier?->bell,
                'carrier_mode' => $this->carrier?->mode,
                'carrier_instruction' => $this->carrier?->instruction,
                'carrier_status' => $this->status,
            ];
        }
        return parent::toArray($request);
    }
}
