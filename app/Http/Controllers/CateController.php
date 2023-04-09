<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cate\StoreCateRequest;
use App\Http\Requests\Cate\UpdateCateRequest;
use App\Http\Resources\Cate\CateCollection;
use App\Http\Resources\Cate\CateResource;
use App\Models\Cate;
use App\Services\CateService;
use App\Traits\ApiResponseTrait;
use Symfony\Component\HttpFoundation\Response;

class CateController extends Controller
{
    private $cateService;

    public function __construct(CateService $cateService)
    {
        $this->cateService = $cateService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Cate::class);

        $cates = new CateCollection($this->cateService->findAll());

        return $this->successResponse($cates, Response::HTTP_OK);
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
    public function store(StoreCateRequest $request)
    {
        $this->authorize('create', Cate::class);

        $cate = $this->cateService->create($request->validated());

        return $this->successResponse($cate, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cate $cate)
    {
        $this->authorize('view', Cate::class);

        $cate = new CateResource($cate);

        return $this->successResponse($cate, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cate $cate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCateRequest $request, Cate $cate)
    {
        $this->authorize('update', Cate::class);

        $this->cateService->update($request->validated(), $cate);

        return $this->successResponse($cate, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cate $cate)
    {
        $this->authorize('delete', Cate::class);

        $this->cateService->delete($cate);

        return $this->successResponse(null, Response::HTTP_NO_CONTENT);
    }
}