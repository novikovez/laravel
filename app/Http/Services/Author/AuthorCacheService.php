<?php

namespace App\Http\Services\Author;

use App\Http\Repositories\Author\Iterators\AuthorsIterator;
use Illuminate\Support\Facades\Cache;
class AuthorCacheService
{
    public function getAuthorCache(string $key): AuthorsIterator|null
    {
        return Cache::get($key);
    }

    public function setAuthorCache(AuthorsIterator $authorsIterator, string $key): void
    {
        Cache::add($key, $authorsIterator, 60);
    }
}
