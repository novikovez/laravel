<?php

namespace App\Http\Resources\Author;

use App\Http\Repositories\Category\Iterators\CategoryIterator;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Author $resource */
        $resource = $this->resource;
        return [
            'id' => $resource->id,
            'name' => $resource->name
        ];
    }
}
