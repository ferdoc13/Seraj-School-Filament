<?php

namespace App\Enums\Enums\Users;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum UsersType: string implements HasLabel, HasColor
{
    case STAFF = 'staff';
    case USER = 'user';

    public function getLabel(): string
    {
        return match ($this) {
            self::STAFF => 'کارمند',
            self::USER => 'کاربر',
        };
    }
    public function getColor(): string
    {
        return match ($this) {
            self::STAFF => 'warning',
            self::USER => 'primary',
        };
    }
}

