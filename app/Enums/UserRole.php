<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserRole extends Enum
{
    const SYSTEM = 1;
    const BESINESS = 2;
    const USER = 3;
}
