<?php

namespace App\Enum;

enum PaymentsEnum: int
{
    case PAYPAL = 1;
    case STRIPE = 2;


}
