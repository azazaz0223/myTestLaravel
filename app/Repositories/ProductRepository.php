<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function create(array $request)
    {
        return auth()->user()->products()->create($request)->refresh();
    }
    public function update(array $request, Product $product)
    {
        $request['operator_id'] = auth()->user()->id;

        return $product->update($request);
    }

    public function findAll($request)
    {
        $limit = $request->limit;

        $query = Product::query();

        if (isset($request->name)) {
            $query->where('name', 'like', $request->name . "%");
        }

        return $query->orderBy('id', 'desc')
            ->paginate($limit)
            ->appends($request->query());
    }
}