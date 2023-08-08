<?php

namespace App\Http\Repositories\Category\Iterators;

use App\Http\Repositories\Book\Iterators\BookIterator;
use ArrayIterator;
use Illuminate\Support\Collection;
use IteratorAggregate;

class CategoriesIterator implements IteratorAggregate
{
    protected array $data = [];

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
