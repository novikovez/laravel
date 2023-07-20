<?php

namespace App\Http\Controllers\Book;

use App\Enum\LangEnum;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Book\BookIndexDTO;
use App\Http\Repositories\Book\BookStoreDTO;
use App\Http\Repositories\Book\BookUpdateDTO;
use App\Http\Repositories\Book\Iterators\BookIterator;
use App\Http\Requests\Book\BookAllRequest;
use App\Http\Requests\Book\BookDestroyRequest;
use App\Http\Requests\Book\BookIndexRequest;
use App\Http\Requests\Book\BookShowRequest;
use App\Http\Requests\Book\BookStoreRequest;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Http\Resources\Book\BookResource;
use App\Http\Services\Book\BookServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    // виклик сервісу
    public function __construct(
        protected BookServices $bookServices,
    )
    {
    }

    public function index(BookIndexRequest $request): AnonymousResourceCollection
    {
        $data = $request->validated();
        return BookResource::collection(
            $this->bookServices->index(
                new BookIndexDTO(
                    $data['startDate'],
                    $data['endDate'],
                    $data['year'],
                    LangEnum::tryFrom($data['lang']),
                    $data['lastId'],
                )
            )
        );
    }

    public function store(BookStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        return $this->getStoreResponse(
            new BookResource(
                $this->bookServices->store(
                    new BookStoreDTO(
                        $data['name'],
                        $data['year'],
                        LangEnum::from($data['lang']),
                        $data['pages'],
                        $data['category_id'],
                    )
                )
            )
        );
    }

    public function show(BookShowRequest $request): BookResource
    {
        $data = $request->validated();
        return new BookResource($this->bookServices->show($data['id']));
    }

    public function update(BookUpdateRequest $request): BookResource
    {
        $data = $request->validated();

        return new BookResource(
            $this->bookServices->update(
                new BookUpdateDTO(
                    $data['id'],
                    $data['name'],
                    $data['year'],
                    LangEnum::from($data['lang']),
                    $data['pages'],
                )
            )
        );
    }

    public function destroy(BookDestroyRequest $request): Response
    {
        $data = $request->validated();
        $this->bookServices->destroy($data['id']);
        return $this->getNoContentResponse();
    }

    public function updateLang(): string
    {
        return $this->bookServices->updateLang();
    }
}
