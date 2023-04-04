<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function cacheUrl($url, $queryParams) : string
    {
        // 重新排列，大家一致
        ksort($queryParams);

        // 將此轉為string
        $queryString = http_build_query($queryParams);

        // 重新組合
        return $url . '?' . $queryString;
    }

    public function findAll($request)
    {
        return $this->productRepository->findAll($request);
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