<?php

namespace App\Http\Resources\Book;

use App\Http\Repositories\Author\Iterators\AuthorBooksIterator;
use App\Http\Repositories\Author\Iterators\AuthorsIterator;
use App\Http\Repositories\Book\DTO\BooksIteratorDTO;
use App\Http\Repositories\Book\Iterators\BookIterator;
use App\Http\Repositories\Book\Iterators\BooksIterator;
use App\Http\Resources\Author\AuthorResource;
use App\Http\Resources\Author\AuthorResourceIterator;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResourceIterator extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function toArray(Request $request): array
    {

        /** @var BooksIteratorDTO $resource */
        $resource = $this->resource;
        $authors = $resource->getBookAuthorsIterator()->getIterator()->getArrayCopy();
        return [
            'id' => $resource->getBookIterator()->getId(),
            'name' => $resource->getBookIterator()->getName(),
            'year' => $resource->getBookIterator()->getYear(),
            'lang' =>$resource->getBookIterator()->getLang(),
            'pages' => $resource->getBookIterator()->getPages(),
            'author' => BookAuthorResource::collection($authors)
        ];
    }
}
