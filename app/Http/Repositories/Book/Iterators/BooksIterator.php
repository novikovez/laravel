<?php

namespace App\Http\Repositories\Book\Iterators;

use App\Http\Repositories\Author\Iterators\AuthorsIterator;
use App\Http\Repositories\Book\DTO\BooksIteratorDTO;
use App\Http\Repositories\Book\Iterators\BookIterator;
use App\Http\Repositories\Category\Iterators\CategoryIterator;
use ArrayIterator;
use Illuminate\Support\Collection;
use IteratorAggregate;

class BooksIterator implements IteratorAggregate
{
    protected array $data = [];

    /**
     * @throws \Exception
     */
    public function __construct(Collection $collection)
    {
        $collection = $collection->groupBy('book_id');
        foreach ($collection as $item) {
            $dto = new BooksIteratorDTO(
                new BookIterator($item->unique('author_id')[0]),
                new BookAuthorsIterator($item)
            );
            $this->data[] = $dto;

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
