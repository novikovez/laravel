<?php

namespace App\Http\Services\Author;

use App\Http\Repositories\Author\AuthorRepository;
use App\Http\Repositories\Author\Iterators\AuthorsIterator;
use App\Http\Repositories\Category\CategoryRepository;
use App\Http\Repositories\Category\Iterators\CategoryIterator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class AuthorServices
{

    public function __construct(
        protected AuthorRepository $authorRepository
    )
    {
    }

    public function indexModel(): Collection
    {
        return $this->authorRepository->indexModel();

    }

    /**
     * @throws \Exception
     */
    public function showIterator(): AuthorsIterator
    {
        return Cache::remember('authors', 60, function () {
            return $this->authorRepository->showIterator();
        });
    }
}
