<?php

namespace App\Http\Resources\Book;

use App\Http\Repositories\Author\Iterators\AuthorBooksIterator;
use App\Http\Repositories\Author\Iterators\AuthorsIterator;
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

        /** @var BooksIterator $resource */
        $resource = $this->resource;
        return [
            'id' => $resource[0]->getId(),
            'name' => $resource[0]->getName(),
            'year' => $resource[0]->getYear(),
            'lang' =>$resource[0]->getLang(),
            'pages' => $resource[0]->getPages(),
            'authors' => BookAuthorResource::collection($resource[1]->getIterator()->getArrayCopy())
        ];
    }
}
