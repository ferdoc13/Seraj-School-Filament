<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class UsersOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        // محاسبه روند کاربران در 30 روز گذشته
        $usersTrend = Trend::model(User::class)
            ->between(
                start: now()->subDays(30),
                end: now(),
            )
            ->perDay()
            ->count();

        $usersCount = User::count();
        $usersLast30Days = User::where('created_at', '>=', now()->subDays(30))->count();
        $previousUsersCount = User::where('created_at', '<', now()->subDays(30))->count();
        $usersChange = $usersLast30Days;
        $usersChangePercent = $previousUsersCount > 0 ? round(($usersChange / $previousUsersCount) * 100, 1) : ($usersChange > 0 ? 100 : 0);

        // محاسبه روند دانش‌آموزان در 30 روز گذشته
        $studentsTrend = Trend::model(Student::class)
            ->between(
                start: now()->subDays(30),
                end: now(),
            )
            ->perDay()
            ->count();

        $studentsCount = Student::count();
        $studentsLast30Days = Student::where('created_at', '>=', now()->subDays(30))->count();
        $previousStudentsCount = Student::where('created_at', '<', now()->subDays(30))->count();
        $studentsChange = $studentsLast30Days;
        $studentsChangePercent = $previousStudentsCount > 0 ? round(($studentsChange / $previousStudentsCount) * 100, 1) : ($studentsChange > 0 ? 100 : 0);

        // محاسبه کارمندان (کاربرانی که دانش‌آموز نیستند)
        $employeesCount = User::whereDoesntHave('students')->count();
        $employeesLast30Days = User::whereDoesntHave('students')
            ->where('created_at', '>=', now()->subDays(30))
            ->count();
        $previousEmployeesCount = User::whereDoesntHave('students')
            ->where('created_at', '<', now()->subDays(30))
            ->count();
        $employeesChange = $employeesLast30Days;
        $employeesChangePercent = $previousEmployeesCount > 0 ? round(($employeesChange / $previousEmployeesCount) * 100, 1) : ($employeesChange > 0 ? 100 : 0);

        // محاسبه روند کارمندان (کاربرانی که دانش‌آموز نیستند) در 30 روز گذشته
        // دریافت داده‌های کارمندان به صورت گروه‌بندی شده بر اساس روز
        $employeesByDay = User::whereDoesntHave('students')
            ->where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        // ایجاد آرایه کامل برای 30 روز گذشته (تعداد روزانه)
        $employeesTrendData = [];
        $startDate = now()->subDays(30)->startOfDay();
        $endDate = now()->endOfDay();
        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            $dateKey = $currentDate->format('Y-m-d');
            $employeesTrendData[] = $employeesByDay[$dateKey] ?? 0;
            $currentDate->addDay();
        }

        return [
            Stat::make('تعداد کاربران', number_format($usersCount))
                ->description(
                    ($usersChange >= 0 ? '+' : '').number_format($usersChange).' ('.
                    ($usersChangePercent >= 0 ? '+' : '').$usersChangePercent.'%)'
                )
                ->descriptionIcon(
                    $usersChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down',
                    IconPosition::Before
                )
                ->chart($usersTrend->map(fn (TrendValue $value) => $value->aggregate)->toArray())
                ->color($usersChange >= 0 ? 'success' : 'danger'),
            Stat::make('تعداد دانش آموزان', number_format($studentsCount))
                ->description(
                    ($studentsChange >= 0 ? '+' : '').number_format($studentsChange).' ('.
                    ($studentsChangePercent >= 0 ? '+' : '').$studentsChangePercent.'%)'
                )
                ->descriptionIcon(
                    $studentsChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down',
                    IconPosition::Before
                )
                ->chart($studentsTrend->map(fn (TrendValue $value) => $value->aggregate)->toArray())
                ->color($studentsChange >= 0 ? 'success' : 'danger'),
            Stat::make('تعداد کارمندان', number_format($employeesCount))
                ->description(
                    ($employeesChange >= 0 ? '+' : '').number_format($employeesChange).' ('.
                    ($employeesChangePercent >= 0 ? '+' : '').$employeesChangePercent.'%)'
                )
                ->descriptionIcon(
                    $employeesChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down'
                )
                ->chart($employeesTrendData)
                ->color($employeesChange >= 0 ? 'success' : 'danger'),
        ];
    }
}
