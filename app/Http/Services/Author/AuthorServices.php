<?php

namespace App\Http\Services\Author;

use App\Http\Repositories\Author\AuthorRepository;
use App\Http\Repositories\Category\CategoryRepository;
use App\Http\Repositories\Category\Iterators\CategoryIterator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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

}
