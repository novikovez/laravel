<?php

namespace App\Http\Resources\Category;

use App\Http\Repositories\Book\Iterators\BooksIterator;
use App\Http\Repositories\Category\Iterators\CategoryIterator;
use App\Http\Resources\Book\BookResource;
use App\Http\Resources\Book\BookResourceIterator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function toArray(Request $request): array
    {
        /** @var CategoryIterator $resource */
        $resource = $this->resource;
        return [
            'category_id' => $resource->getId(),
            'category_name' => $resource->getName(),
           // 'books' => BookResource::collection($resource->getBooksIterator()->getIterator()->getArrayCopy())
        ];
    }
}
