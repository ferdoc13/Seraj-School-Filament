<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Facades\Filament;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use App\Models\User;
use App\Models\Level;
use App\Enums\Students\StudentField;
class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        $isUserPanel = Filament::getCurrentPanel()->getId() === 'user';
        return $schema
            ->components([
                $isUserPanel
                    ? Hidden::make('user_id')
                    ->default(fn () => auth()->id())
                    : Select::make('user_id')
                    ->label('کاربر')
                    ->options(User::all()->pluck('name', 'id'))
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('first_name')
                    ->label('نام')
                    ->required(),
                TextInput::make('last_name')
                    ->label('نام خانوادگی')
                    ->required(),
                TextInput::make('national_code')
                    ->label('کد ملی')
                    ->required(),
                DatePicker::make('birth_date')
                    ->label('تاریخ تولد')
                    ->required()
                    ->jalali(),
                Select::make('level_id')
                    ->label('مقطع')
                    ->options(Level::all()->pluck('name', 'id'))
                    ->required(),
                Select::make('field')
                    ->label('رشته')
                    ->options(StudentField::class)
                    ->required(),
                Toggle::make('status')
                    ->label('وضعیت')
                    ->inline(false)
                    ->default(true),

            ]);
    }
}
