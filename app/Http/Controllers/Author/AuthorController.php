<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryDestroyRequest;
use App\Http\Requests\Category\CategoryShowRequest;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Resources\Author\AuthorResourceIterator;
use App\Http\Resources\Author\AuthorResourceModel;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoryResourceModel;
use App\Http\Services\Author\AuthorServices;
use App\Http\Services\Category\CategoryServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    // виклик сервісу
    public function __construct(
        protected AuthorServices $authorServices,
    )
    {
    }

    public function indexModel(): AnonymousResourceCollection
    {
        return AuthorResourceModel::collection(
            $this->authorServices->indexModel()
        );
    }

    /**
     * @throws \Exception
     */
    public function showIterator(): AnonymousResourceCollection
    {
        $result = $this->authorServices->showIterator();
        return AuthorResourceIterator::collection($result->getIterator()->getArrayCopy());
    }
}
