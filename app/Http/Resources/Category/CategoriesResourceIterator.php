<?php

namespace App\Http\Resources\Category;

use App\Http\Repositories\Book\Iterators\BooksIterator;
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
        /** @var CategoriesIterator $resource */
        $resource = $this->resource;
        //dd($resource);
        return [
            'category_id' => $resource[0]->getId(),
            'category_name' => $resource[0]->getName(),
            'books' => BooksCategoriesResource::collection($resource[1]->getIterator()->getArrayCopy())
        ];
    }
}
