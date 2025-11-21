<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Level;
class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Level::create([
            'name' => 'مقطع 1',
            'status' => true,
        ]);
        Level::create([
            'name' => 'مقطع 2',
            'status' => true,
        ]);
        Level::create([
            'name' => 'مقطع 3',
            'status' => true,
        ]);
    }
}
