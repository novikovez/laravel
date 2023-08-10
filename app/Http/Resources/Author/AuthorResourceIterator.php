<?php

namespace App\Http\Resources\Author;

use App\Http\Repositories\Author\Iterators\AuthorBooksIterator;
use App\Http\Repositories\Author\Iterators\AuthorsIterator;
use App\Http\Repositories\Category\Iterators\CategoryIterator;
use App\Http\Resources\Book\BookResource;
use App\Http\Resources\Book\BookResourceIterator;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResourceIterator extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var AuthorsIterator $resource */
        $resource = $this->resource;
        return [
            'author_id' => $resource[0]->getId(),
            'author_name' => $resource[0]->getName(),
            'books' => AuthorBookResource::collection($resource[1]->getIterator()->getArrayCopy()),
        ];
    }
}
