<?php

namespace App\Filament\Resources\Dishes\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
class DishForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('نام غذا')
                    ->required(),
                TextInput::make('price')
                    ->label('قیمت')
                    ->required()
                    ->numeric()
                    ->prefix('ریال'),
                Textarea::make('description')
                    ->label('توضیحات')
                    ->columnSpanFull()
                    ->required(),
                Toggle::make('status')
                    ->label('وضعیت')
                    ->required(),
            ]);
    }
}
