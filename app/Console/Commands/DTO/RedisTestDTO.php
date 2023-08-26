<?php

namespace App\Console\Commands\DTO;

use JsonSerializable;

class RedisTestDTO implements JsonSerializable
{
    public function __construct(
        protected string $name,
        protected int $year,
    )
    {
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'year' => $this->year
        ];
    }
}
