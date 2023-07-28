<?php

namespace App\Http\Services\DZ11;

class bService
{

    public function bService($data) {
        return $this->count($data);
    }

    public function count($numbers): int
    {
        $count = 0;

        foreach ($numbers as $number) {
            if ($number % 2 !== 0) {
                $count++;
            }
        }

        return $count;
    }
}
