<?php

namespace App\Http\Resources\Author;

use App\Http\Repositories\Author\DTO\AuthorsIteratorDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResourceIterator extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function toArray(Request $request): array
    {
        /** @var AuthorsIteratorDTO $resource */
        $resource = $this->resource;
        $books = $resource->getAuthorBooksIterator()->getIterator()->getArrayCopy();
        return [
            'author_id' => $resource->getAuthorIterator()->getId(),
            'author_name' => $resource->getAuthorIterator()->getName(),
            'books' => AuthorBookResource::collection($books),
        ];
    }
}
