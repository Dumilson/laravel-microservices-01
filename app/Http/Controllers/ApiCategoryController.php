<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Http\Request;

class ApiCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $repository;
     

    public function __construct(Category $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {
        return CategoryResource::collection($this->repository->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCategoryRequest $request)
    {
        // $data = $request->validated();
        // $data['url'] = Str::slug($data['title'],'-');
        return new CategoryResource($this->repository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        return new CategoryResource($this->repository->where('url', $url)->firstOrFail());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCategoryRequest $request, $url)
    {
        $category = $this->repository->where('url', $url)->firstOrFail();
        $category->update($request->validated());

        return response()->json([
            'message' => 'Categoria atualizada com sucesso !'
        ]);
        // return new CategoryResource($cate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function destroy($url)
    {
        $category = $this->repository->where('url', $url)->firstOrFail();
        $category->delete();
        return response()->json([
            'message' => 'Categoria deleteda com sucesso !'
        ]);
    }
}
