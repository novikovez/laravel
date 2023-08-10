<?php

namespace App\Http\Repositories\Author\Iterators;

use App\Http\Repositories\Author\Iterators\AuthorBooksIterator;
use App\Http\Repositories\Author\Iterators\AuthorsIterator;
use App\Http\Repositories\Category\Iterators\CategoryIterator;
use Illuminate\Support\Collection;


class AuthorIterator
{
    protected int $id;
    protected string $name;


    public function __construct(object $data)
    {
        $this->id = $data->author_id;
        $this->name = $data->author_name;
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
