<?php

namespace App\Enums;

enum ContractStatus: int
{
    const CREATED = 0;
    const PENDING_CONSOLIDATION = 1;
    const PENDING_SIGN = 2;
    const SIGNED_ALL = 3;
    const TERMINATED = 4;
    const DECLINE = 5;
    const DECLINE_CONTRACTOR = 6;
}
