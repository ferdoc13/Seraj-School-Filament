<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use App\Enums\Enums\Users\UsersType;
class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->label('نام و نام خانوادگی')
                    ->minLength(3)
                    ->maxLength(255)
                    ->validationMessages([
                        'min' => 'نام و نام خانوادگی نمی تواند کمتر از 3 کاراکتر باشد',
                        'max' => 'نام و نام خانوادگی نمی تواند بیشتر از 255 کاراکتر باشد',
                        'required' => 'نام و نام خانوادگی الزامی است',
                    ]),
                TextInput::make('mobile')
                    ->required()
                    ->label('شماره موبایل')
                    ->minLength(11)
                    ->maxLength(11),
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
                    ->searchable()
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
