<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->label('نام و نام خانوادگی')
                    ->maxLength(255),
                TextInput::make('mobile')
                    ->required()
                    ->label('شماره موبایل')
                    ->maxLength(255),
                TextInput::make('email')
                    ->required()
                    ->label('ایمیل')
                    ->maxLength(255),
                Toggle::make('status')
                    ->inline(false)
                    ->label('وضعیت')
                    ->default(true),
                Select::make('type')
                    ->label('نوع')
                    ->options(UsersType::class)
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->label('رمز عبور')
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->maxLength(255),
            ]);
    }
}
