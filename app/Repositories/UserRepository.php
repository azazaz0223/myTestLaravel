<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function create(User $user)
    {
        return $user->create();
    }

    public function assignRole(User $user, $roles)
    {
        return $user->assignRole($roles);
    }

// public function update(array $request, Product $product)
// {
//     $request['operator_id'] = auth()->user()->id;

//     return $product->update($request);
// }

// public function findAll($request)
// {
//     $limit = $request->limit;

//     $query = Product::query();

//     if (isset($request->name)) {
//         $query->where('name', 'like', $request->name . "%");
//     }

//     return $query->orderBy('id', 'desc')
//         ->paginate($limit)
//         ->appends($request->query());
// }

// public function delete(Product $product)
// {
//     return $product->delete();
// }
}