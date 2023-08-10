<?php

namespace App\Http\Resources\Category;

use App\Http\Repositories\Book\Iterators\BookIterator;
use App\Http\Repositories\Book\Iterators\BooksIterator;
use App\Http\Repositories\Category\Iterators\CategoryIterator;
use App\Http\Resources\Book\BookResource;
use App\Http\Resources\Book\BookResourceIterator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BooksCategoriesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     * @throws \Exception
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
        ];
    }
}
