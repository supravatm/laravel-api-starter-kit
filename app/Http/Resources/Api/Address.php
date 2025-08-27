<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Address extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->is('api/*'))
        {
            return [
                'id' => $this->id,
                'user_id' => $this->user_id,
                'carrier_id' => $this->carrier_id,
                'evening_carrier_id' => $this->evening_carrier_id,
                'delivery_route_id' => $this->delivery_route_id,
                'available_city_id' => $this->available_city_id,
                'is_default' => (bool) $this->is_default,
                'status' => $this->status,
                'name' => $this->name,
                'phone' => $this->phone,
                'apartment_name' => $this->apartment_name,
                'flat_no' => $this->flat_no,
                'landmark' => $this->landmark,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'formatted_address' => $this->formatted_address,
                'postal_code' => $this->postal_code,
                'street_address' => $this->street_address,
                'route' => $this->route,
                'country' => $this->country,
                'administrative_area_level_1' => $this->administrative_area_level_1,
                'administrative_area_level_2' => $this->administrative_area_level_2,
                'administrative_area_level_3' => $this->administrative_area_level_3,
                'administrative_area_level_4' => $this->administrative_area_level_4,
                'locality' => $this->locality,
                'sublocality' => $this->sublocality,
                'neighborhood' => $this->neighborhood,
                'plus_code' => $this->plus_code,
                'created_at' => $this->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            ];
        }
        return parent::toArray($request);
    }
}
