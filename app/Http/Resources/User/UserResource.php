<?php

namespace App\Http\Resources\User;

use App\Http\Services\User\Login\LoginDTO;
use App\Http\Services\User\UserIterator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var LoginDTO $resource */
        $resource = $this->resource;
        return [
            'id' => $resource->getUserId(),
            'email' => $resource->getEmail(),
        ];
    }
}
