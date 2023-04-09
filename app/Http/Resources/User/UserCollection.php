<?php

namespace App\Http\Resources\User;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Request;

class UserCollection extends PaginateResource
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
                'data' => $this->collection->transform(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at
                    ];
                })
            ]
        );
    }
}