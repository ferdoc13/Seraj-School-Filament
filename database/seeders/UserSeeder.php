<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'فردوک',
            'mobile' => '09353646265',
            'email' => 'ferdo30.ir@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => true,
        ]);
    }
}
