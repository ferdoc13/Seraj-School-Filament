<?php

namespace App\Filament\Resources\Levels\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
class LevelsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('نام مقطع')
                    ->sortable()
                    ->searchable(),
                IconColumn::make('status')
                    ->label('وضعیت')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('وضعیت')
                    ->options([
                        1 => 'فعال',
                        0 => 'غیرفعال',
                    ]),
                SelectFilter::make('field')
                    ->label('رشته')
                    ->options([
                        'عمومی' => 'عمومی',
                        'ریاضی' => 'ریاضی',
                        'انسانی' => 'انسانی',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
