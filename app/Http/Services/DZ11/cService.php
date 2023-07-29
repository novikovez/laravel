<?php

namespace App\Http\Services\DZ11;

use App\Http\Services\DZ11\Methods\lessTen;

class cService
{
    public function __construct(
        protected lessTen $lessTen,
    )
    {
    }

    public function cService($data): int
    {
        $result = $this->lessTen->getLessTenInt($data);
        return count($result);
    }

}
