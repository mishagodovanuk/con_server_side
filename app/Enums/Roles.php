<?php

namespace App\Enums;

enum Roles : string
{
    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';
    case USER = 'user';

    case LOGISTIC = 'logistic';

    case DISPATCHER = 'dispatcher';

    public function label(): string
    {
        return match ($this) {
            static::SUPER_ADMIN => 'Адміністратор системи',
            static::ADMIN => 'Адміністратор',
            static::USER => 'Користувач',
            static::LOGISTIC => 'Логіст',
            static::DISPATCHER => 'Диспетчер',

        };
    }
}
