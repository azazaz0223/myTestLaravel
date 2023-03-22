<?php

namespace App\Http\Controllers;

use App\Http\Resources\CateCollection;
use App\Http\Resources\CateResource;
use App\Models\Cate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => [
                'required',
                'max:50',
                Rule::unique('cates', 'name')
            ],
            'sort' => 'nullable|integer'
        ]);

        $cate = Cate::create($request->all())->refresh();

        return response([ 'data' => $cate ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cate $cate)
    {
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
        $cate->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}