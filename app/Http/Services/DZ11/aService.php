<?php

namespace App\Http\Services\DZ11;

use App\Http\Services\DZ11\Methods\evenNumber;

class aService
{

    public function __construct(
        protected evenNumber $evenNumber,
    )
    {
    }

    public function aService($data): int
    {
      $result = $this->evenNumber->getEvenInt($data);
      return count($result);
    }

}
