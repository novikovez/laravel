<?php

namespace App\Http\Repositories\Book;

class BookIndexDTO
{
    public function __construct(
        protected string  $startDate,
        protected string  $endDate,
        protected ?int    $year,
        protected ?string $lang,
    )
    {
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
     * @return string|null
     */
    public function getLang(): string|null
    {
        return $this->lang;
    }


}
