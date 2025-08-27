<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CarrierCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->is('api/*'))
        {
            return [
                'items' => $this->collection,
                'meta' => [
                    'items_count' => $this->collection->count(),
                ],
            ];
        }
        return parent::toArray($request);
    }
}
