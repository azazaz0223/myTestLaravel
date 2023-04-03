<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function create(array $product)
    {
        return auth()->user()->products()->create($product)->refresh();
    }
}