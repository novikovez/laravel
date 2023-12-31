<?php

namespace App\Http\Repositories\Book;

use App\Enum\LangEnum;
use JsonSerializable;

class BookStoreDTO implements JsonSerializable
{
    public function __construct(
        protected string $name,
        protected int $year,
        protected string $lang,
        protected int $pages,
        protected int $category_id,
        protected int $author_id,
    ) {
    }

    public function getAuthorId(): int
    {
        return $this->author_id;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
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

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'year' => $this->year,
            'lang' => $this->lang,
            'pages' => $this->pages,
            'category_id' => $this->category_id,
            'author_id' => $this->author_id,
        ];
    }
}
