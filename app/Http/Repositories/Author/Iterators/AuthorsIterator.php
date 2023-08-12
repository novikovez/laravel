<?php

namespace App\Http\Repositories\Author\Iterators;

use App\Http\Repositories\Author\DTO\AuthorsIteratorDTO;
use App\Http\Repositories\Book\DTO\BooksIteratorDTO;
use App\Http\Repositories\Book\Iterators\BookIterator;
use App\Http\Repositories\Book\Iterators\BooksIterator;
use ArrayIterator;
use Exception;
use Illuminate\Support\Collection;
use IteratorAggregate;

class AuthorsIterator implements IteratorAggregate
{
    protected array $data = [];

    /**
     * @throws Exception
     */
    public function __construct(Collection $collection)
    {

        $collection = $collection->groupBy('author_id');
        foreach ($collection as $item) {
            $dto = new AuthorsIteratorDTO(
                new AuthorIterator($item->unique('author_id')[0]),
                new AuthorBooksIterator($item)
            );
            $this->data[] = $dto;
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
