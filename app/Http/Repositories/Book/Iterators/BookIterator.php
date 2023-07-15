<?php

namespace App\Http\Repositories\Book\Iterators;

use App\Http\Repositories\Category\Iterators\CategoryIterator;

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
        $this->id = $data->id;
        $this->name = $data->name;
        $this->year = $data->year;
        $this->lang = $data->lang;
        $this->pages = $data->pages;
        $this->categoryIterator = new CategoryIterator((object)[
            "id" => $data->category_id,
            "name" => $data->category_name
        ]
        );
        $this->created_at = $data->created_at;
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
