<?php

namespace App\Http\Repositories\Category\Iterators;

use App\Http\Repositories\Book\Iterators\BooksIterator;
use Illuminate\Support\Collection;

class CategoryIterator
{
    protected int $id;
    protected string $name;
    protected BooksIterator $booksIterator;

    /**
     * @throws \Exception
     */
    public function __construct(object $data)
    {
        //dd($data[0]);
        $this->id = $data->category_id;
        $this->name = $data->category_name;
    }

    /**
     * @return BooksIterator
     */
    public function getBooksIterator(): BooksIterator
    {
        return $this->booksIterator;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


}
