<?php

namespace App\Http\Resources\Api;

use App\Models\Api\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if($request->is("api/*"))
        {
            return [
                'id' => $this->id,
                'product_id' => $this->product_id,
                'path' => $this->path,
                'default' => $this->default,
                'sort' => $this->sort,
                'status' => $this->status,
                'created_at' => $this->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
                'images' => ProductResource::collection($this->whenLoaded('product'))
            ];
        }
        return parent::toArray($request);
    }
}
