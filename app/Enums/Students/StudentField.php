<?php

namespace App\Enums\Students;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum StudentField: string implements HasLabel, HasColor
{
    case General = 'General';
    case Mathematics = 'Mathematics';
    case Humanities = 'Humanities';

    public function getLabel(): string
    {
        return match ($this) {
            self::General => 'عمومی',
            self::Mathematics => 'ریاضی',
            self::Humanities => 'انسانی',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::General => 'gray',
            self::Mathematics => 'warning',
            self::Humanities => 'info',
        };
    }
}
