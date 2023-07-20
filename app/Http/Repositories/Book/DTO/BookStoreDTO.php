<?php

namespace App\Http\Repositories\Book\DTO;

use App\Enum\LangEnum;

class BookStoreDTO
{
    public function __construct(
        protected string   $name,
        protected int      $year,
        protected LangEnum $lang,
        protected int      $pages,
        protected int      $category_id,
    )
    {
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

    /**
     * @return LangEnum
     */
    public function getLang(): LangEnum
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

}
