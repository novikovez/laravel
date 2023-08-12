<?php

namespace App\Http\Repositories\Author\DTO;

use App\Http\Repositories\Author\Iterators\AuthorBooksIterator;
use App\Http\Repositories\Author\Iterators\AuthorIterator;

class AuthorsIteratorDTO
{
    public function __construct(
        protected AuthorIterator $authorIterator,
        protected AuthorBooksIterator $authorBooksIterator
    )
    {
    }

    /**
     * @return AuthorIterator
     */
    public function getAuthorIterator(): AuthorIterator
    {
        return $this->authorIterator;
    }

    /**
     * @return AuthorBooksIterator
     */
    public function getAuthorBooksIterator(): AuthorBooksIterator
    {
        return $this->authorBooksIterator;
    }
}
