<?php

namespace App\Http\Services\DZ11;

class dService
{

    public function dService($data): int
    {
        return $this->count($data);
    }

    public function count($numbers): int
    {
        $count = 0;

        foreach ($numbers as $number) {
            if ($number > 25 AND $this->honest($number) === true) {
                $count++;
            }
        }

        return $count;
    }

    public function honest(int $int): bool
    {
        if($int % 2 !== 0) {
            return true;
        }
        return false;
    }
}
