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
        protected AuthorCacheService $authorCacheService
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
    public function showIterator(): AuthorsIterator
    {
        $cache = $this->authorCacheService->getAuthorCache('authors');
        if($cache === null)
        {
            $data = $this->authorRepository->showIterator();
            $this->authorCacheService->setAuthorCache($data, 'authors');
            return $data;
        }
        return $cache;
    }
}
