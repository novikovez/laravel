<?php

namespace App\Http\Services\Rabbit\Messages;

class WordCreateDTO
{
    public function __construct(
        protected string $word,
        protected string $result,
    )
    {
    }

    public function getWord(): string
    {
        return $this->word;
    }

    public function getResult(): string
    {
        return $this->result;
    }
}
