<?php

namespace App\Http\Resources\Permission;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PermissionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request) : array
    {
        return [
            'data' => $this->collection->transform(function ($permission) {
                return [
                    'id' => $permission->id,
                    'name' => $permission->name,
                    'created_at' => $permission->created_at,
                    'updated_at' => $permission->updated_at
                ];
            })
        ];
    }
}