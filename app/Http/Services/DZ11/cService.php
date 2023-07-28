<?php

namespace App\Http\Services\DZ11;

class cService
{

    public function cService($data): int
    {
        return $this->count($data);
    }

    public function count($numbers): int
    {
        $count = 0;

        foreach ($numbers as $number) {
            if ($number < 10) {
                $count++;
            }
        }

        return $count;
    }
}
