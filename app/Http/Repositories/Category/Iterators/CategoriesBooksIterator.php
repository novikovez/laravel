<?php

namespace App\Http\Repositories\Category\Iterators;

use App\Http\Repositories\Author\Iterators\AuthorBooksIterator;
use App\Http\Repositories\Author\Iterators\AuthorsIterator;
use App\Http\Repositories\Book\Iterators\BookIterator;
use App\Http\Repositories\Category\Iterators\CategoryIterator;
use ArrayIterator;
use Illuminate\Support\Collection;
use IteratorAggregate;

class CategoriesBooksIterator implements IteratorAggregate
{
    protected array $data = [];

    /**
     * @throws \Exception
     */
    public function __construct(Collection $collection)
    {
        foreach ($collection as $item) {
            $this->data[] = new BookIterator($item);
        }
    }

    public function add(BookIterator $bookIterator): void
    {
        $this->data[] = $bookIterator;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->data);
    }

}
