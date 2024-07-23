<?php

namespace App\Enums;

enum ObligationServiceType: int
{
    case TRANSPORTATION = 1;
    case WAREHOUSE = 2;
    case CUSTOMS_BROKERAGE = 3;
}
