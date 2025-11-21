<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Enums\Students\StudentField;
class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'user_id' => 1,
            'level_id' => 1,
            'first_name' => 'پوریا',
            'last_name' => 'فردوکی',
            'national_code' => '1234567890',
            'status' => true,
            'field' => StudentField::General,
            'birth_date' => '1990-01-01',
        ]);
        Student::factory(10)->create();
    }
}
