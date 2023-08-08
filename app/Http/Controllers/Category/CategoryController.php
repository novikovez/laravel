<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryDestroyRequest;
use App\Http\Requests\Category\CategoryShowRequest;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoryResourceModel;
use App\Http\Services\Category\CategoryServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    // виклик сервісу
    public function __construct(
        protected CategoryServices $categoryServices,
    )
    {
    }

    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection(
            $this->categoryServices->index()
        );
    }

    public function store(CategoryStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        return $this->getStoreResponse(
            new CategoryResource(
                $this->categoryServices->store(
                    $data['name']
                )
            )
        );
    }

    public function show(CategoryShowRequest $request): CategoryResource
    {
        $data = $request->validated();
        return new CategoryResource($this->categoryServices->show($data['id']));
    }

    public function update(CategoryUpdateRequest $request): CategoryResource
    {
        $data = $request->validated();

        return new CategoryResource(
            $this->categoryServices->update(
                $data['id'],
                $data['name']
            )
        );
    }

    public function destroy(CategoryDestroyRequest $request): Response
    {
        $data = $request->validated();
        $this->categoryServices->destroy($data['id']);
        return $this->getNoContentResponse();
    }

    public function showModel(CategoryShowRequest $request): AnonymousResourceCollection
    {
        $data = $request->validated();
        return CategoryResourceModel::collection($this->categoryServices->showModel($request->id));
    }
}
