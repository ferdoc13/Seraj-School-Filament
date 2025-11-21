<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Ariaieboy\FilamentJalali\Tables\Columns\JalaliDateColumn;
use App\Enums\Enums\Users\UsersType;
class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('نام و نام خانوادگی'),
                TextColumn::make('mobile')
                    ->label('شماره موبایل'),
                TextColumn::make('email')
                    ->label('ایمیل'),
                TextColumn::make('type')
                    ->label('نوع')
                    ->formatStateUsing(fn (UsersType $state): string => $state->getLabel())
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->color(fn (UsersType $state): string => $state->getColor()),
                IconColumn::make('status')
                    ->label('وضعیت'),
                TextColumn::make('created_at')
                    ->label('تاریخ ثبت نام')
                    ->dateTime('Y-m-d')
                    ->jalaliDate(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('وضعیت')
                    ->options([
                        1 => 'فعال',
                        0 => 'غیرفعال',
                    ]),
                SelectFilter::make('type')
                    ->label('نوع')
                    ->options(UsersType::class),
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
