<?php

namespace App\Services;

use App\Models\Cate;
use App\Repositories\CateRepository;

class CateService
{
    private CateRepository $cateRepository;

    public function __construct(CateRepository $cateRepository)
    {
        $this->cateRepository = $cateRepository;
    }

    // public function findAll($request)
    // {
    //     return $this->productRepository->findAll($request);
    // }

    public function create($request)
    {
        return $this->cateRepository->create($request);
    }

// public function update($request, $product)
// {
//     $request['operator_id'] = auth()->user()->id;
//     return $this->productRepository->update($request, $product);
// }

// public function delete(Product $product)
// {
//     return $this->productRepository->delete($product);
// }
}