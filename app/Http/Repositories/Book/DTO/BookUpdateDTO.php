<?php

namespace App\Http\Repositories\Book\DTO;

use App\Enum\LangEnum;

class BookUpdateDTO
{
    public function __construct(
        protected int      $id,
        protected string   $name,
        protected int      $year,
        protected LangEnum $lang,
        protected int      $pages,
    )
    {
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
