<?php

namespace App\Http\Services\Rabbit\Messages;

use JsonSerializable;

class BookCreateDTO  implements JsonSerializable
{
    public function __construct(
        protected string $name,
        protected int $year,
        protected string $lang,
        protected int $pages,
        protected int $categoryId,
        protected int $author_id,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getLang(): string
    {
        return $this->lang;
    }

    public function getPages(): int
    {
        return $this->pages;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getAuthorId(): int
    {
        return $this->author_id;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'year' => $this->year,
            'lang' => $this->lang,
            'pages' => $this->pages,
            'category_id' => $this->categoryId,
            'author_id' => $this->author_id,
        ];
    }
}
