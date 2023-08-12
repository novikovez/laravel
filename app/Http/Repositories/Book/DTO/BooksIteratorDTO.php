<?php

namespace App\Http\Repositories\Book\DTO;

use App\Http\Repositories\Book\Iterators\BookAuthorsIterator;
use App\Http\Repositories\Book\Iterators\BookIterator;

class BooksIteratorDTO
{
    public function __construct(
        protected BookIterator $bookIterator,
        protected BookAuthorsIterator $bookAuthorsIterator
    )
    {
    }

    /**
     * @return BookIterator
     */
    public function getBookIterator(): BookIterator
    {
        return $this->bookIterator;
    }

    /**
     * @return BookAuthorsIterator
     */
    public function getBookAuthorsIterator(): BookAuthorsIterator
    {
        return $this->bookAuthorsIterator;
    }
}
