<?php

namespace App\Filament\Resources\Dishes\Pages;

use App\Filament\Resources\Dishes\DishResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditDish extends EditRecord
{
    protected static string $resource = DishResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
