<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 取得網址
        $url = $request->url;

        // 取得get params
        $queryParams = $request->query();
        // 重新排列，大家一致
        ksort($queryParams);

        // 將此轉為string
        $queryString = http_build_query($queryParams);

        // 重新組合
        $fullUrl = "{$url}?{$queryString}";

        if (Cache::has($fullUrl)) {
            return Cache::get($fullUrl);
        }

        $limit = $request->limit ?? 10;

        $query = Product::query()->with('cate');

        if (isset($request->name)) {
            $query->where('name', 'like', $request->name . "%");
        }

        $products = $query->orderBy('id', 'desc')
            ->paginate($limit)
            ->appends($request->query());

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
    public function store(Request $request)
    {
        $this->validate($request, [
            'cate_id' => 'nullable|exists:cates,id',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable'
        ]);

        $product = Product::create($request->all())->refresh();
        return response($product, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
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
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'cate_id' => 'nullable|exists:cates,id',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable'
        ]);

        $product->update($request->all());
        return response($product, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}