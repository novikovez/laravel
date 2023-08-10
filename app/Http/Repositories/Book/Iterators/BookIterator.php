<?php

namespace App\Http\Repositories\Book\Iterators;

use App\Http\Repositories\Author\Iterators\AuthorBooksIterator;
use App\Http\Repositories\Author\Iterators\AuthorsIterator;
use App\Http\Repositories\Category\Iterators\CategoryIterator;
use Illuminate\Support\Collection;


class BookIterator
{
    protected int $id;
    protected string $name;
    protected int $year;
    protected string $lang;
    protected int $pages;
    protected string $created_at;
    protected CategoryIterator $categoryIterator;

    public function __construct(object $data)
    {
        $this->id = $data->book_id;
        $this->name = $data->book_name;
        $this->year = $data->book_year;
        $this->lang = $data->book_lang;
        $this->pages = $data->book_pages;
    }


    /**
     * @return CategoryIterator
     */
    public function getCategoryIterator(): CategoryIterator
    {
        return $this->categoryIterator;
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

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }

    /**
     * @return int
     */
    public function getPages(): int
    {
        return $this->pages;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

}
