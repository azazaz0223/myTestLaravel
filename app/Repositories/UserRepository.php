<?php

namespace App\Repositories;

use App\Models\User;
use DB;

class UserRepository
{
    public function create($user, $roles)
    {
        $user = DB::transaction(function () use ($user, $roles) {
            $user = User::create($user)->refresh();
            $user->assignRole($roles);
            return $user;
        });
        return $user;
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