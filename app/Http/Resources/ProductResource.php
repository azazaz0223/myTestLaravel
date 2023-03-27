<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request) : array
    {
        return [
            "id" => $this->id,
            "cate" => [
                "id" => $this->cate->id,
                "name" => $this->cate->name
            ],
            "name" => $this->name,
            "description" => $this->description,
            "enabled" => $this->enabled,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "operator" => [
                'id' => $this->operator->id,
                'name' => $this->operator->name
            ]
        ];
    }
}