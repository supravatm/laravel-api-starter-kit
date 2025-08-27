<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class Address extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Set to true to allow the request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'carrier_id' => 'nullable|exists:carriers,id',
            'evening_carrier_id' => 'nullable|exists:carriers,id',
            'delivery_route_id' => 'nullable|exists:delivery_routes,id',
            'available_city_id' => 'nullable|exists:available_cities,id',
            'is_default' => 'nullable|boolean',
            'status' => 'required|string',
            'name' => 'required|string',
            'phone' => 'required|string',
            'apartment_name' => 'nullable|string',
            'flat_no' => 'nullable|string',
            'landmark' => 'nullable|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'formatted_address' => 'required|string',
            'postal_code' => 'required|string',
            'street_address' => 'nullable|string',
            'route' => 'nullable|string',
            'country' => 'nullable|string',
            'administrative_area_level_1' => 'nullable|string',
            'administrative_area_level_2' => 'nullable|string',
            'administrative_area_level_3' => 'nullable|string',
            'administrative_area_level_4' => 'nullable|string',
            'locality' => 'nullable|string',
            'sublocality' => 'nullable|string',
            'neighborhood' => 'nullable|string',
            'plus_code' => 'nullable|string',
        ];
    }
}
