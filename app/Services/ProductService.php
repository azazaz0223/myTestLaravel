<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function create($request)
    {
        return $this->productRepository->create($request);
    }

    public function update($request, $product)
    {
        $request['operator_id'] = auth()->user()->id;
        return $this->productRepository->update($request, $product);
    }
}