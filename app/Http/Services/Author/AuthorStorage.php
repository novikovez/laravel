<?php

namespace App\Http\Services\Author;

use App\Http\Repositories\Author\Iterators\AuthorsIterator;
use Illuminate\Support\Facades\Cache;

class AuthorStorage
{
    protected const KEY = 'author';
    protected const TIME = 60;

    public function has(int $last_id): bool
    {
        return Cache::has($this->getKey($last_id));
    }

    public function get(int $last_id): AuthorsIterator
    {
        return Cache::get($this->getKey($last_id));
    }

    public function set(AuthorsIterator $authorsIterator, int $last_id): void
    {
        Cache::add($this->getKey($last_id), $authorsIterator, self::TIME);
    }

    private function getKey(int $last_id): string
    {
        return self::KEY . '_' . $last_id;
    }
}
