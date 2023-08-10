<?php

namespace App\Http\Repositories\Author\Iterators;

use App\Http\Repositories\Book\Iterators\BookIterator;
use App\Http\Repositories\Book\Iterators\BooksIterator;
use ArrayIterator;
use Exception;
use Illuminate\Support\Collection;
use IteratorAggregate;

class AuthorBooksIterator implements IteratorAggregate
{
    protected array $data = [];

    /**
     * @throws Exception
     */
    public function __construct(Collection $collection)
    {
        foreach ($collection as $item) {
            $this->data[] = new BookIterator($item);
        }
    }

    public function add(AuthorBooksIterator $authorIterator): void
    {
        $this->data[] = $authorIterator;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->data);
    }

}
