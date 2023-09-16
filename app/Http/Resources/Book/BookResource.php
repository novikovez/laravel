<?php

namespace App\Http\Resources\Book;

use App\Http\Repositories\Book\Iterators\BookIterator;
use App\Http\Resources\Author\AuthorResource;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var BookIterator $resource */
        $resource = $this->resource;
        return [
            'id' => $resource->getId(),
            'name' => $resource->getName(),
            'year' => $resource->getYear(),
            'lang' => $resource->getLang(),
            'pages' => $resource->getPages(),
            'category' => new CategoryResource($resource->getCategoryIterator()),
            'author' => new AuthorResource($resource->getAuthorIterator()),
        ];
    }
}
