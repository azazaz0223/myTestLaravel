<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request) : array
    {
        return [
            'data' => $this->collection->transform(function ($product) {
                return [
                    'id' => $product->id,
                    'cate_name' => $product->cate->name,
                    'enabled' => $product->enabled,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at
                ];
            })
        ];
    }
}