<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Request;

class ProductCollection extends PaginateResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request) : array
    {
        return array_merge(
            parent::toArray($request),
            [
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
            ]
        );
    }
}