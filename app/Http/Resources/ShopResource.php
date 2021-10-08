<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $product = $this->whenLoaded('product');
        return [
            'id' => $this->id,
            'name' => $this->name,
            'product'=>  ProductResource::collection($product)
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,

        ];
    }
    public function with($request)
    {
        return ['status' => 'success'];
    }
}
