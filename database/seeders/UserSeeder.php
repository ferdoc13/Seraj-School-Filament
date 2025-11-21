<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Enums\Enums\Users\UsersType;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'فردوک',
            'mobile' => '09123456789',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'status' => true,
            'type' => UsersType::STAFF,
        ]);

        User::factory(10)->create();
    }
}
