<?php

namespace App\Http\Resources\Category;

use App\Http\Repositories\Book\Iterators\BooksIterator;
use App\Http\Repositories\Category\CategoriesIteratorDTO;
use App\Http\Repositories\Category\Iterators\CategoriesIterator;
use App\Http\Repositories\Category\Iterators\CategoryIterator;
use App\Http\Resources\Book\BookResource;
use App\Http\Resources\Book\BookResourceIterator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResourceIterator extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function toArray(Request $request): array
    {
        /** @var CategoriesIteratorDTO $resource */
        $resource = $this->resource;
        $books = $resource->getCategoriesBooksIterator()->getIterator()->getArrayCopy();
        //dd($resource);
        return [
            'category_id' => $resource->getCategoryIterator()->getId(),
            'category_name' => $resource->getCategoryIterator()->getName(),
            'books' => BooksCategoriesResource::collection($books)
        ];
    }
}
