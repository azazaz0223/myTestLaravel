<?php

namespace App\Repositories;

use App\Models\Cate;

class CateRepository
{
    public function create(array $request)
    {
        return auth()->user()->cates()->create($request)->refresh();
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