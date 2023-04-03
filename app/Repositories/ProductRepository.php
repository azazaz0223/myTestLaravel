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
}