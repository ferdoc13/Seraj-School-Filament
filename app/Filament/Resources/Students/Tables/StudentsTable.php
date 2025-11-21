<?php

namespace App\Filament\Resources\Students\Tables;

use App\Enums\Students\StudentField;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')
                    ->label('نام'),
                TextColumn::make('last_name')
                    ->label('نام خانوادگی'),
                TextColumn::make('user.name')
                    ->label('نام والد'),
                TextColumn::make('national_code')
                    ->label('کد ملی'),
                TextColumn::make('level.name')
                    ->label('مقطع')
                    ->sortable()
                    ->searchable()
                    ->badge(),
                TextColumn::make('field')
                    ->label('رشته')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->formatStateUsing(fn (StudentField $state): string => $state->getLabel())
                    ->color(fn (StudentField $state): string => $state->getColor()),
                TextColumn::make('birth_date')
                    ->label('تاریخ تولد')
                    ->jalaliDate(),
                IconColumn::make('status')
                    ->label('وضعیت')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('تاریخ ثبت')
                    ->dateTime('Y-m-d')
                    ->jalaliDate(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
