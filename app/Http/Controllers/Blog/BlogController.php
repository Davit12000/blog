<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\BlogRequest;
use App\Http\Requests\Blog\BlogUpdateRequest;
use App\Http\Resources\Blog\BlogResource;
use App\Models\Blog;
use App\Services\BlogService\BlogService;

class BlogController extends Controller
{
    /**
     * Crud the Blog model using the Service below.
     */
    public $service;

    public function __construct(BlogService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BlogResource::collection(Blog::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $data=$request->validated();
        $hasTag = $request->has('tag');
        return $this->service->store($data, $hasTag);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return new BlogResource($blog);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogUpdateRequest $request, Blog $blog)
    {
        $data=$request->validated();
        $hasTags = $request->has('tag');
        return $this->service->update($data, $blog, $hasTags);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $this->authorize('delete', $blog);
        return $this->service->delete($blog);
    }
}
