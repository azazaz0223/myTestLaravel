<?php

namespace App\Http\Resources;

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
                    'cate' => [
                        'id' => $product->cate->id,
                        'name' => $product->cate->name
                    ],
                    'operator' => [
                        'name' => $product->operator->name
                    ],
                    'enabled' => $product->enabled,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at
                ];
            })
        ];
    }
}