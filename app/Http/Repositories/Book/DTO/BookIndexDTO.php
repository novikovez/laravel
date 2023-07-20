<?php

namespace App\Http\Repositories\Book\DTO;

use App\Enum\LangEnum;

class BookIndexDTO
{
    public function __construct(
        protected string  $startDate,
        protected string  $endDate,
        protected ?int    $year,
        protected ?LangEnum $lang,
        protected ?int $lastId,
    )
    {
    }

    /**
     * @return int|null
     */
    public function getLastId(): ?int
    {
        return $this->lastId;
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->endDate;
    }

    /**
     * @return int|null
     */
    public function getYear(): int|null
    {
        return $this->year;
    }

    /**
     * @return LangEnum|null
     */
    public function getLang(): LangEnum|null
    {
        return $this->lang;
    }


}
