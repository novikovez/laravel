<?php

namespace App\Http\Resources\Category;

use App\Http\Repositories\Category\Iterators\CategoryIterator;
use App\Http\Resources\Book\BookResourceModel;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Stripe\Collection;

class CategoryResourceModel extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Category $resource */
        $resource = $this->resource;
        //dd($resource->book);
        return [
            'id' => $resource->id,
            'name' => $resource->author,
            'books' => BookResourceModel::collection($resource->book)
        ];
    }
}
