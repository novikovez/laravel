<?php

namespace App\Http\Services\DZ11;

use App\Http\Services\DZ11\Methods\evenNumber;
use App\Http\Services\DZ11\Methods\moreTwentyFive;

class dService
{
    public function __construct(
        protected evenNumber $evenNumber,
        protected moreTwentyFive $moreTwentyFive,
    )
    {
    }

    public function dService($data): int
    {
        $even = $this->evenNumber->getEvenInt($data);
        $result = $this->moreTwentyFive->getMoreTwentyFiveInt($even);

        return count($result);


    }




}


