<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CateCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request) : array
    {
        return [
            'data' => $this->collection->transform(function ($cate) {
                return [
                    'id' => $cate->id,
                    'name' => $cate->name,
                    'sort' => $cate->sort,
                    'created_at' => $cate->created_at,
                    'updated_at' => $cate->updated_at
                ];
            })
        ];
    }
}