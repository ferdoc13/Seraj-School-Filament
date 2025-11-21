<?php

namespace App\Filament\Resources\Levels\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;

class LevelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('نام مقطع')
                    ->required(),
                Toggle::make('status')
                    ->label('وضعیت')
                    ->default(true),
            ]);
    }
}
