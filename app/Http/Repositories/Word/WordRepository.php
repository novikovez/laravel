<?php

namespace App\Http\Repositories\Word;

use App\Http\Services\Rabbit\Messages\WordCreateDTO;
use Illuminate\Support\Facades\DB;

class WordRepository
{
    public function store(WordCreateDTO $wordCreateDTO): void
    {
        DB::table('words')
            ->insert([
                "word" =>  $wordCreateDTO->getWord(),
                "result" => $wordCreateDTO->getResult(),
            ]);
    }
}
