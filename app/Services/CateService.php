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

    public function findAll()
    {
        return $this->cateRepository->findAll();
    }

    public function create($request)
    {
        return $this->cateRepository->create($request);
    }

    public function update($request, $cate)
    {
        $request['operator_id'] = auth()->user()->id;
        return $this->cateRepository->update($request, $cate);
    }

// public function delete(Product $product)
// {
//     return $this->productRepository->delete($product);
// }
}