<?php

namespace App\Http\Services\Author;

use App\Http\Repositories\Author\AuthorRepository;
use App\Http\Repositories\Author\Iterators\AuthorsIterator;
use App\Http\Repositories\Category\CategoryRepository;
use App\Http\Repositories\Category\Iterators\CategoryIterator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class AuthorServices
{

    public function __construct(
        protected AuthorRepository $authorRepository,
        protected AuthorStorage $authorStorage
    )
    {
    }

    public function indexModel(): Collection
    {
        return $this->authorRepository->indexModel();

    }

    /**
     * @throws Exception
     */
    public function showIterator(int $last_id): AuthorsIterator
    {
        if($this->authorStorage->has($last_id) === false)
        {
            $data = $this->authorRepository->showIterator($last_id);
            $this->authorStorage->set($data, $last_id);
            return $data;
        }
        return $this->authorStorage->get($last_id);
    }
}
