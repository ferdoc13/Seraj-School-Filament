<?php

namespace App\Filament\Resources\Menus\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use App\Models\Dish;
class MenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date')
                    ->label('تاریخ')
                    ->required()
                    ->minDate(now()->addDays(1))
                    ->maxDate(now()->addDays(30))
                    ->jalali(),
                Select::make('dish_id')
                    ->label('غذا')
                    ->options(Dish::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),
            ]);
    }
}
