<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cate\StoreCateRequest;
use App\Http\Resources\CateCollection;
use App\Http\Resources\CateResource;
use App\Models\Cate;
use App\Services\CateService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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

        $cates = Cate::select('id', 'name', 'sort', 'created_at', 'updated_at')->get();

        return new CateCollection($cates);
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

        $cate = $this->cateService->create($request);

        return response([ 'data' => $cate ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cate $cate)
    {
        $this->authorize('view', Cate::class);

        return new CateResource($cate);
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
    public function update(Request $request, Cate $cate)
    {
        $this->authorize('update', Cate::class);

        $this->validate($request, [
            'name' => [
                'max:50',
                Rule::unique('cates', 'name')->ignore($cate->name, 'name')
            ],
            'sort' => 'nullable|integer'
        ]);

        $cate->update($request->all());

        return response([ 'data' => $cate ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cate $cate)
    {
        $this->authorize('delete', Cate::class);

        $cate->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}