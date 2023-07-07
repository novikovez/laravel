<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookStoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => rand(1,9),
            'name' => $this->resource->name,
            'author' => $this->resource->author,
            'year' => $this->resource->year,
            'countPages' => $this->resource->countPages,
        ];
    }
}
