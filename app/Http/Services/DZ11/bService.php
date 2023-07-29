<?php

namespace App\Http\Services\DZ11;

use App\Http\Services\DZ11\Methods\oddNumber;

class bService
{
    public function __construct(
        protected oddNumber $oddNumber
    )
    {
    }

    public function bService($data): int
    {
        $result = $this->oddNumber->getOddInt($data);
        return count($result);
    }


}
