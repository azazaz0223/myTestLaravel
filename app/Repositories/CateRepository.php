<?php

namespace App\Repositories;

use App\Models\Cate;

class CateRepository
{
    public function create(array $request)
    {
        return auth()->user()->cates()->create($request)->refresh();
    }

    public function update(array $request, Cate $cate)
    {
        $request['operator_id'] = auth()->user()->id;

        return $cate->update($request);
    }

    public function findAll()
    {
        return Cate::query()->
            select('id', 'name', 'sort', 'created_at', 'updated_at')
            ->orderBy('sort', 'desc')
            ->get();
    }

// public function delete(Product $product)
// {
//     return $product->delete();
// }
}