<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\IndexProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(IndexProductRequest $request)
    {
        $this->authorize('viewAny', Product::class);

        $fullUrl = $this->productService->cacheUrl($request->url, $request->query());

        if (Cache::has($fullUrl)) {
            return Cache::get($fullUrl);
        }

        $products = $this->productService->findAll($request);

        return Cache::remember($fullUrl, 60, function () use ($products) {
            return new ProductCollection($products);
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $this->authorize('create', Product::class);

        $product = $this->productService->create($request->validated());

        return response($product, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $this->authorize('view', Product::class);

        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('update', Product::class);

        $this->productService->update($request->validated(), $product);

        return response($product, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', Product::class);

        $this->productService->delete($product);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}