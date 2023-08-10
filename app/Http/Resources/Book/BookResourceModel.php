<?php

namespace App\Http\Resources\Book;

use App\Http\Repositories\Book\Iterators\BookIterator;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResourceModel extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Book $resource */
        $resource = $this->resource;

        return [
            'id' => $resource->id,
            'name' => $resource->name,
            'year' => $resource->year,
            'lang' => $resource->lang,
            'pages' => $resource->pages,
        ];
    }
}
